<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use Exception;
use InvalidArgumentException;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Smartcore\InPostInternational\Exception\ApiException;
use Smartcore\InPostInternational\Model\Api\ErrorProcessor;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Data\AddressDto;
use Smartcore\InPostInternational\Model\Data\DestinationDto;
use Smartcore\InPostInternational\Model\Data\DimensionsDto;
use Smartcore\InPostInternational\Model\Data\InsuranceDto;
use Smartcore\InPostInternational\Model\Data\LabelDto;
use Smartcore\InPostInternational\Model\Data\OriginDto;
use Smartcore\InPostInternational\Model\Data\ParcelDto;
use Smartcore\InPostInternational\Model\Data\PhoneDto;
use Smartcore\InPostInternational\Model\Data\RecipientDto;
use Smartcore\InPostInternational\Model\Data\ReferencesDto;
use Smartcore\InPostInternational\Model\Data\SenderDto;
use Smartcore\InPostInternational\Model\Data\ShipmentDto;
use Smartcore\InPostInternational\Model\Data\ShipmentTypeFactory;
use Smartcore\InPostInternational\Model\Data\ShipmentTypeInterface;
use Smartcore\InPostInternational\Model\Data\ValueAddedServicesDto;
use Smartcore\InPostInternational\Model\Data\WeightDto;
use Smartcore\InPostInternational\Model\ParcelTemplateRepository;
use Smartcore\InPostInternational\Model\PickupAddressRepository;
use Smartcore\InPostInternational\Model\Shipment;
use Smartcore\InPostInternational\Model\ShipmentRepository;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ShipmentProcessor
{

    /**
     * ShipmentProcessor constructor.
     *
     * @param ShipmentTypeFactory $shipmentTypeFactory
     * @param ConfigProvider $configProvider
     * @param PickupAddressRepository $pickupAddrRepository
     * @param ParcelTemplateRepository $parcelTmplRepository
     * @param InternationalApiService $apiService
     * @param ErrorProcessor $errorProcessor
     * @param ShipmentRepository $shipmentRepository
     */
    public function __construct(
        private readonly ShipmentTypeFactory      $shipmentTypeFactory,
        private readonly ConfigProvider           $configProvider,
        private readonly PickupAddressRepository  $pickupAddrRepository,
        private readonly ParcelTemplateRepository $parcelTmplRepository,
        private readonly InternationalApiService  $apiService,
        private readonly ErrorProcessor           $errorProcessor,
        private readonly ShipmentRepository       $shipmentRepository
    ) {
    }

    /**
     * Process shipment creation
     *
     * @param array<mixed> $formData
     * @throws LocalizedException
     */
    public function process(array $formData): void
    {
        try {
            $shipmentFieldsetData = $formData['shipment_fieldset'];
            $shipmentSendingType = $shipmentFieldsetData['shipment_type'] ?? null;
            /** @var ShipmentTypeInterface $shipmentType */
            $shipmentType = $this->shipmentTypeFactory->create($shipmentSendingType);
            $shipmentType->setLabelFormat($shipmentFieldsetData['label_format']);
            $shipmentType->setShipment($this->createShipment($shipmentFieldsetData));

            $apiResponse =  $this->apiService->createShipment($shipmentType);
            $this->processApiResponse($shipmentType, $apiResponse, $formData);
        } catch (ApiException $e) {
            $orderId = $shipmentFieldsetData['order_increment_id'] ?? null;
            $errors = $this->errorProcessor->processErrors($e->getResponse());
            array_unshift($errors, ($orderId)
                ? __(sprintf('Shipment creation for order %s failed because of error(s):', $orderId))
                : __('Shipment creation failed.'));
            $errorMsg = implode("<br/>", $errors);
            throw new LocalizedException(__($errorMsg));
        } catch (Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
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

        try {
            $this->shipmentRepository->save($shipment);
        } catch (AlreadyExistsException $e) {
            throw new LocalizedException(__('Shipment with the same UUID already exists.'));
        } catch (LocalizedException $e) {
            throw new LocalizedException(
                __(sprintf('Shipment save failed because of error: %s.', $e->getMessage()))
            );
        }
    }

    /**
     * Create shipment object
     *
     * @param array $shipmentFieldsetData
     * @return ShipmentDto
     */
    private function createShipment(array $shipmentFieldsetData): ShipmentDto
    {
        $shipment = new ShipmentDto();
        $shipment->setSender($this->createSender())
            ->setRecipient($this->createRecipient($shipmentFieldsetData))
            ->setOrigin($this->createOrigin($shipmentFieldsetData))
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
        $sender = new SenderDto();
        $sender->setCompanyName($senderSettings['company_name'])
            ->setFirstName($senderSettings['first_name'])
            ->setLastName($senderSettings['last_name'])
            ->setEmail($senderSettings['email'])
            ->setPhone($this->createPhone($phoneData))
            ->setLanguageCode($senderSettings['language']);
        return $sender;
    }

    /**
     * Create phone object
     *
     * @psalm-param array{prefix: string, number: string} $phoneData
     * @param array<string> $phoneData
     * @return PhoneDto
     * @throws InvalidArgumentException If required keys are missing.
     */
    private function createPhone(array $phoneData): PhoneDto
    {
        $phone = new PhoneDto();
        return $phone->setPrefix($phoneData['prefix'])
            ->setNumber($phoneData['number']);
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
        $recipient = new RecipientDto();
        $recipient->setFirstName($shipmentFieldsetData['first_name'])
            ->setLastName($shipmentFieldsetData['last_name'])
            ->setCompanyName($shipmentFieldsetData['company_name'])
            ->setEmail($shipmentFieldsetData['email'])
            ->setPhone($this->createPhone($phoneData))
            ->setLanguageCode($shipmentFieldsetData['language_code']);

        return $recipient;
    }

    /**
     * Create origin object
     *
     * @param array $shipmentFieldsetData
     * @return OriginDto
     */
    private function createOrigin(array $shipmentFieldsetData): OriginDto
    {
        $pickupAddress = $this->pickupAddrRepository->load((int) $shipmentFieldsetData['origin']);

        $address = new AddressDto();
        $address->setHouseNumber($pickupAddress->getHouseNumber())
            ->setStreet($pickupAddress->getStreet())
            ->setCity($pickupAddress->getCity())
            ->setPostalCode($pickupAddress->getPostalCode())
            ->setCountryCode($pickupAddress->getCountryCode());

        $origin = new OriginDto();
        $origin->setAddress($address);
        return $origin;
    }

    /**
     * Create destination object
     *
     * @param array $shipmentFieldsetData
     * @return DestinationDto
     */
    private function createDestination(array $shipmentFieldsetData): DestinationDto
    {
        $destination = new DestinationDto();
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
        $insurance = new InsuranceDto();
        $insurance->setValue((float) $shipmentFieldsetData['insurance_value'])
            ->setCurrency($shipmentFieldsetData['insurance_currency']);

        $valueAddedServices = new ValueAddedServicesDto();
        $valueAddedServices->setInsurance($insurance);

        return $valueAddedServices;
    }

    /**
     * Create references
     *
     * @param array $shipmentFieldsetData
     * @return ReferencesDto|null
     */
    private function createReferences(array $shipmentFieldsetData): ?ReferencesDto
    {
        if (!isset($shipmentFieldsetData['custom_reference'])) {
            return null;
        }
        $references = new ReferencesDto();
        $references->setCustom($shipmentFieldsetData['custom_reference']);

        return $references;
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

        $dimensions = new DimensionsDto();
        $dimensions->setLength($parcelTemplate->getLength())
            ->setWidth($parcelTemplate->getWidth())
            ->setHeight($parcelTemplate->getHeight())
            ->setUnit($parcelTemplate->getDimensionUnit());

        $weight = new WeightDto();
        $weight->setAmount($parcelTemplate->getWeight())
            ->setUnit($parcelTemplate->getWeightUnit());

        $label = new LabelDto();
        $label->setComment($parcelTemplate->getComment())
            ->setBarcode($parcelTemplate->getBarcode());

        $parcel = new ParcelDto();
        $parcel->setType($parcelTemplate->getType())
            ->setDimensions($dimensions)
            ->setWeight($weight)
            ->setLabel($label);

        return $parcel;
    }

    /**
     * Enrich shipment with API response
     *
     * @param Shipment $shipmentDbModel
     * @param array<mixed> $apiResponse
     * @param array<mixed> $formData
     * @return Shipment
     */
    private function enrichShipmentWithApiResponse(
        Shipment $shipmentDbModel,
        array $apiResponse,
        array $formData
    ): Shipment {
        $parcelNumbers = $formData['parcel']['parcel_numbers'] ?? null;
        if ($formData['parcel']['trackingNumber'] ?? null) {
            $parcelNumbers['trackingNumber'] = $formData['parcel']['trackingNumber'];
        }
        $orderId = isset($formData['shipment_fieldset']['order_id'])
            ? (int) $formData['shipment_fieldset']['order_id']
            : null;
        $shipmentDbModel
            ->setOrderId($orderId)
            ->setLabelUrl($apiResponse['label']['url'] ?? null)
            ->setUuid($apiResponse['uuid'] ?? null)
            ->setTrackingNumber($apiResponse['tracking_number'] ?? null)
            ->setParcelUuid($apiResponse['parcel']['uuid'] ?? null)
            ->setParcelNumbers($parcelNumbers)
            ->setRoutingDeliveryArea($apiResponse['routing']['delivery_area'] ?? null)
            ->setRoutingDeliveryDepotNumber(
                $apiResponse['routing']['delivery_depot_number']
                    ?? null
            )
            ->setParcelStatus($apiResponse['status'] ?? null);
        return $shipmentDbModel;
    }
}
