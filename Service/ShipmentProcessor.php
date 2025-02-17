<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use Exception;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Smartcore\InPostInternational\Exception\ApiException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\Api\ErrorProcessor;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Data\AbstractDtoBuilder;
use Smartcore\InPostInternational\Model\Data\DestinationDto;
use Smartcore\InPostInternational\Model\Data\DimensionsDto;
use Smartcore\InPostInternational\Model\Data\InsuranceDto;
use Smartcore\InPostInternational\Model\Data\LabelDto;
use Smartcore\InPostInternational\Model\Data\ParcelDto;
use Smartcore\InPostInternational\Model\Data\RecipientDto;
use Smartcore\InPostInternational\Model\Data\SenderDto;
use Smartcore\InPostInternational\Model\Data\ShipmentDto;
use Smartcore\InPostInternational\Model\Data\ShipmentTypeFactory;
use Smartcore\InPostInternational\Model\Data\ShipmentTypeInterface;
use Smartcore\InPostInternational\Model\Data\ValueAddedServicesDto;
use Smartcore\InPostInternational\Model\Data\WeightDto;
use Smartcore\InPostInternational\Model\InPostShipment;
use Smartcore\InPostInternational\Model\InPostShipmentRepository;
use Smartcore\InPostInternational\Model\ParcelTemplateRepository;
use Smartcore\InPostInternational\Ui\DataProvider\Shipment\CreateDataProvider;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ShipmentProcessor extends CommonProcessor
{
    public const SHIPMENT_FIELDSET = 'shipment_fieldset';
    public const ORDER_ID_REPLACE_TEMPLATE = '{orderId}';

    /**
     * ShipmentProcessor constructor.
     *
     * @param ShipmentTypeFactory $shipmentTypeFactory
     * @param ConfigProvider $configProvider
     * @param ParcelTemplateRepository $parcelTmplRepository
     * @param InternationalApiService $apiService
     * @param ErrorProcessor $errorProcessor
     * @param InPostShipmentRepository $shipmentRepository
     * @param AbstractDtoBuilder $abstractDtoBuilder
     * @param CreateDataProvider $createDataProvider
     * @param EventManager $eventManager
     */
    public function __construct(
        private readonly ShipmentTypeFactory      $shipmentTypeFactory,
        private readonly ConfigProvider           $configProvider,
        private readonly ParcelTemplateRepository $parcelTmplRepository,
        private readonly InternationalApiService  $apiService,
        private readonly ErrorProcessor           $errorProcessor,
        private readonly InPostShipmentRepository $shipmentRepository,
        private readonly AbstractDtoBuilder       $abstractDtoBuilder,
        private readonly CreateDataProvider       $createDataProvider,
        private readonly EventManager             $eventManager
    ) {
        parent::__construct($this->abstractDtoBuilder);
    }

    /**
     * Process shipment creation
     *
     * @param array<mixed> $formData
     * @throws LocalizedException
     * @throws TokenSaveException
     */
    public function process(array $formData): void
    {
        try {
            $shipmentFieldsetData = $formData[self::SHIPMENT_FIELDSET];
            $shipmentSendingType = $shipmentFieldsetData['shipment_type'] ?? null;
            /** @var ShipmentTypeInterface $shipmentType */
            $shipmentType = $this->shipmentTypeFactory->create($shipmentSendingType);
            $shipmentType->setLabelFormat($shipmentFieldsetData['label_format']);
            $shipmentType->setShipment($this->createShipmentDto($shipmentFieldsetData, $shipmentType));

            $apiResponse = $this->apiService->createApiShipment($shipmentType);
            $this->processApiResponse($shipmentType, $apiResponse, $formData);
        } catch (TokenSaveException $e) {
            throw new TokenSaveException($e->getMessage());
        } catch (ApiException $e) {
            $errors = $this->errorProcessor->processErrors($e->getResponse());

            $errorMsg = implode("<br/>", $errors);
            throw new LocalizedException(__($errorMsg));
        } catch (Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
    }

    /**
     * Create shipment for order
     *
     * @param int $orderId
     * @return void
     * @throws LocalizedException
     * @throws TokenSaveException
     */
    public function createInPostShipmentForOrder(int $orderId): void
    {
        $orderShipmentData = $this->createDataProvider->prepareDataForOrderId($orderId);
        $this->process($orderShipmentData);
    }

    /**
     * Update shipment from API
     *
     * @param InPostShipment $shipmentDbModel
     * @throws AlreadyExistsException
     * @throws LocalizedException
     * @throws TokenSaveException
     */
    public function updateInPostShipmentFromApi(InPostShipment $shipmentDbModel): void
    {
        $apiShipment = $this->apiService->getApiShipment($shipmentDbModel);
        if ($apiShipment['status'] !== $shipmentDbModel->getParcelStatus()) {
            $shipmentDbModel->setParcelStatus($apiShipment['status']);
            $this->shipmentRepository->save($shipmentDbModel);
        }
    }

    /**
     * Process API response
     *
     * @param ShipmentTypeInterface $shipmentDto
     * @param array $apiResponse
     * @param array $formData
     * @throws LocalizedException
     */
    private function processApiResponse(
        ShipmentTypeInterface $shipmentDto,
        array                 $apiResponse,
        array                 $formData
    ): void {
        $shipment = $shipmentDto->toDbModel();
        $shipment = $this->enrichShipmentWithApiResponse($shipment, $apiResponse, $formData);

        $this->dispatchEvent($shipment);

        try {
            $this->shipmentRepository->save($shipment);
        } catch (AlreadyExistsException $e) {
            throw new LocalizedException(__('Shipment with the same UUID already exists.'));
        } catch (LocalizedException $e) {
            throw new LocalizedException(
                __('Shipment save failed because of error: %1.', $e->getMessage())
            );
        }
    }

    /**
     * Dispatch events
     *
     * @param InPostShipment $shipment
     * @return void
     */
    private function dispatchEvent(InPostShipment $shipment): void
    {
        if ($shipment->getId()) {
            $this->eventManager->dispatch(
                'inpostinternational_shipment_updated',
                ['inpostInternationalShipment' => $shipment]
            );
            return;
        }

        $this->eventManager->dispatch(
            'inpostinternational_shipment_created',
            ['inpostInternationalShipment' => $shipment]
        );
    }

    /**
     * Create shipment object
     *
     * @param array $shipmentFieldsetData
     * @param ShipmentTypeInterface $shipmentType
     * @return ShipmentDto
     */
    private function createShipmentDto(array $shipmentFieldsetData, ShipmentTypeInterface $shipmentType): ShipmentDto
    {
        /** @var ShipmentDto $shipment */
        $shipment = $this->abstractDtoBuilder->buildDtoInstance(ShipmentDto::class);
        $shipment->setSender($this->createSender())
            ->setRecipient($this->createRecipient($shipmentFieldsetData))
            ->setOrigin($shipmentType->createOrigin($shipmentFieldsetData))
            ->setDestination($this->createDestination($shipmentFieldsetData))
            ->setPriority($this->createPriority($shipmentFieldsetData))
            ->setValueAddedServices($this->createValueAddedServices($shipmentFieldsetData))
            ->setReferences($this->createReferences($shipmentFieldsetData))
            ->setParcel($this->createParcel($shipmentFieldsetData));
        return $shipment;
    }

    /**
     * Create recipient object
     *
     * @return SenderDto
     */
    private function createSender(): SenderDto
    {
        $senderSettings = $this->configProvider->getSenderSettings();
        $phoneData = [
            'prefix' => $senderSettings['phone_prefix'],
            'number' => $senderSettings['phone_number']
        ];
        /** @var SenderDto $sender */
        $sender = $this->abstractDtoBuilder->buildDtoInstance(SenderDto::class);
        $sender->setCompanyName($senderSettings['company_name'])
            ->setFirstName($senderSettings['first_name'])
            ->setLastName($senderSettings['last_name'])
            ->setEmail($senderSettings['email'])
            ->setPhone($this->createPhone($phoneData))
            ->setLanguageCode($senderSettings['language']);
        return $sender;
    }

    /**
     * Create recipient object
     *
     * @param array $shipmentFieldsetData
     * @return RecipientDto
     */
    private function createRecipient(array $shipmentFieldsetData): RecipientDto
    {
        $phoneData = [
            'prefix' => $shipmentFieldsetData['phone_prefix'],
            'number' => $shipmentFieldsetData['phone_number']
        ];
        /** @var RecipientDto $recipient */
        $recipient = $this->abstractDtoBuilder->buildDtoInstance(RecipientDto::class);
        $recipient->setFirstName($shipmentFieldsetData['first_name'])
            ->setLastName($shipmentFieldsetData['last_name'])
            ->setCompanyName($shipmentFieldsetData['company_name'])
            ->setEmail($shipmentFieldsetData['email'])
            ->setPhone($this->createPhone($phoneData))
            ->setLanguageCode($shipmentFieldsetData['language_code']);

        return $recipient;
    }

    /**
     * Create destination object
     *
     * @param array $shipmentFieldsetData
     * @return DestinationDto
     */
    private function createDestination(array $shipmentFieldsetData): DestinationDto
    {
        /** @var DestinationDto $destination */
        $destination = $this->abstractDtoBuilder->buildDtoInstance(DestinationDto::class);
        $destination->setCountryCode($shipmentFieldsetData['destination_country'])
            ->setPointName($shipmentFieldsetData['point_name']);
        return $destination;
    }

    /**
     * Create priority
     *
     * @param array $shipmentFieldsetData
     * @return string
     */
    private function createPriority(array $shipmentFieldsetData): string
    {
        return $shipmentFieldsetData['priority'];
    }

    /**
     * Create value added services
     *
     * @param array $shipmentFieldsetData
     * @return ValueAddedServicesDto
     */
    private function createValueAddedServices(array $shipmentFieldsetData): ValueAddedServicesDto
    {
        /** @var InsuranceDto $insurance */
        $insurance = $this->abstractDtoBuilder->buildDtoInstance(InsuranceDto::class);
        $insurance->setValue((float) $shipmentFieldsetData['insurance_value'])
            ->setCurrency($shipmentFieldsetData['insurance_currency']);

        /** @var ValueAddedServicesDto $valueAddedServices */
        $valueAddedServices = $this->abstractDtoBuilder->buildDtoInstance(ValueAddedServicesDto::class);
        $valueAddedServices->setInsurance($insurance);

        return $valueAddedServices;
    }

    /**
     * Create parcel object
     *
     * @param array $shipmentFieldsetData
     * @return ParcelDto
     */
    private function createParcel(array $shipmentFieldsetData): ParcelDto
    {
        $parcelTemplate = $this->parcelTmplRepository->load((int) $shipmentFieldsetData['parcel_template']);

        /** @var DimensionsDto $dimensions */
        $dimensions = $this->abstractDtoBuilder->buildDtoInstance(DimensionsDto::class);
        $dimensions->setLength($parcelTemplate->getLength())
            ->setWidth($parcelTemplate->getWidth())
            ->setHeight($parcelTemplate->getHeight())
            ->setUnit($parcelTemplate->getDimensionUnit());

        /** @var WeightDto $weight */
        $weight = $this->abstractDtoBuilder->buildDtoInstance(WeightDto::class);
        $weight->setAmount($parcelTemplate->getWeight())
            ->setUnit($parcelTemplate->getWeightUnit());

        /** @var ParcelDto $parcel */
        $parcel = $this->abstractDtoBuilder->buildDtoInstance(ParcelDto::class);
        $parcel->setType($parcelTemplate->getType())
            ->setDimensions($dimensions)
            ->setWeight($weight);

        $comment = $parcelTemplate->getComment() && isset($shipmentFieldsetData['order_increment_id'])
            ? str_replace(
                self::ORDER_ID_REPLACE_TEMPLATE,
                $shipmentFieldsetData['order_increment_id'],
                $parcelTemplate->getComment()
            )
            : '';

        $barcode = $parcelTemplate->getBarcode() && isset($shipmentFieldsetData['order_increment_id'])
            ? substr(
                preg_replace('/[^A-Za-z0-9]/', '', str_replace(
                    self::ORDER_ID_REPLACE_TEMPLATE,
                    $shipmentFieldsetData['order_increment_id'],
                    $parcelTemplate->getBarcode()
                )),
                0,
                16
            )
            : '';

        $shouldAddLabel = $comment && $barcode;
        if ($shouldAddLabel) {
            /** @var LabelDto $label */
            $label = $this->abstractDtoBuilder->buildDtoInstance(LabelDto::class);
            $label->setComment($comment)
                ->setBarcode($barcode);
            $parcel->setLabel($label);
        }

        return $parcel;
    }

    /**
     * Enrich shipment with API response
     *
     * @param InPostShipment $shipmentDbModel
     * @param array<mixed> $apiResponse
     * @param array<mixed> $formData
     * @return InPostShipment
     */
    private function enrichShipmentWithApiResponse(
        InPostShipment $shipmentDbModel,
        array          $apiResponse,
        array          $formData
    ): InPostShipment {
        $parcelNumbers = $apiResponse['parcel']['parcelNumbers'] ?? null;
        if ($apiResponse['parcel']['trackingNumber'] ?? null) {
            $parcelNumbers['trackingNumber'] = $apiResponse['parcel']['trackingNumber'];
        }
        $orderId = isset($formData[self::SHIPMENT_FIELDSET]['order_id'])
            && $formData[self::SHIPMENT_FIELDSET]['order_id']
            ? (int) $formData[self::SHIPMENT_FIELDSET]['order_id']
            : null;
        $shipmentDbModel
            ->setOrderId($orderId)
            ->setLabelUrl($apiResponse['label']['url'] ?? null)
            ->setUuid($apiResponse['uuid'] ?? null)
            ->setTrackingNumber($apiResponse['trackingNumber'] ?? null)
            ->setParcelUuid($apiResponse['parcel']['uuid'] ?? null)
            ->setParcelNumbers(json_encode($parcelNumbers))
            ->setRoutingDeliveryArea($apiResponse['routing']['deliverArea'] ?? null)
            ->setRoutingDeliveryDepotNumber(
                $apiResponse['routing']['deliveryDepotNumber']
                    ?? null
            )
            ->setParcelStatus($apiResponse['status'] ?? null);
        return $shipmentDbModel;
    }
}
