<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Smartcore\InPostInternational\Exception\ApiException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\Api\ErrorProcessor;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;
use Smartcore\InPostInternational\Model\Data\AbstractDtoBuilder;
use Smartcore\InPostInternational\Model\Data\AddressDto;
use Smartcore\InPostInternational\Model\Data\ContactPersonDto;
use Smartcore\InPostInternational\Model\Data\OneTimePickupDto;
use Smartcore\InPostInternational\Model\Data\PickupTimeDto;
use Smartcore\InPostInternational\Model\Data\TotalWeightDto;
use Smartcore\InPostInternational\Model\Data\VolumeDto;
use Smartcore\InPostInternational\Model\Pickup;
use Smartcore\InPostInternational\Model\PickupAddress;
use Smartcore\InPostInternational\Model\PickupAddressRepository;
use Smartcore\InPostInternational\Model\PickupFactory;
use Smartcore\InPostInternational\Model\PickupRepository;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class OneTimePickupProcessor extends CommonProcessor
{

    public const PICKUP_FIELDSET = 'pickup_fieldset';

    /**
     * OneTimePickupProcessor constructor.
     *
     * @param PickupFactory $pickupFactory
     * @param PickupAddressRepository $pickupAddrRepository
     * @param PickupRepository $pickupRepository
     * @param InternationalApiService $apiService
     * @param AbstractDtoBuilder $abstractDtoBuilder
     * @param TimezoneInterface $timezone
     * @param ErrorProcessor $errorProcessor
     */
    public function __construct(
        private readonly PickupFactory $pickupFactory,
        private readonly PickupAddressRepository $pickupAddrRepository,
        private readonly PickupRepository $pickupRepository,
        private readonly InternationalApiService $apiService,
        private readonly AbstractDtoBuilder $abstractDtoBuilder,
        private readonly TimezoneInterface $timezone,
        private readonly ErrorProcessor $errorProcessor,
    ) {
        parent::__construct($this->abstractDtoBuilder);
    }

    /**
     * Process one-time pickup
     *
     * @param array $formData
     * @return void
     * @throws LocalizedException
     * @throws ApiException
     * @throws TokenSaveException
     */
    public function process(array $formData): void
    {
        try {
            $pickupFieldsetData = $formData[self::PICKUP_FIELDSET];
            /** @var Pickup $pickup */
            $pickup = $this->pickupFactory->create();
            $pickup->setData($pickupFieldsetData);

            /** @var PickupAddress $pickupAddress */
            $pickupAddress = $this->pickupAddrRepository->load((int) $pickupFieldsetData['pickup_address']);
            $pickupAddress->copyToPickup($pickup);

            $oneTimePickupDto = $this->createOneTimePickupDto($pickupFieldsetData);

            $this->apiService->createApiOneTimePickup($oneTimePickupDto);
            $this->pickupRepository->save($pickup);
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
     * Create OneTimePickupDto object
     *
     * @param array $pickupFieldsetData
     * @return OneTimePickupDto
     * @throws LocalizedException
     */
    public function createOneTimePickupDto(array $pickupFieldsetData): OneTimePickupDto
    {
        /** @var OneTimePickupDto $oneTimePickupDto */
        $oneTimePickupDto = $this->abstractDtoBuilder->buildDtoInstance(OneTimePickupDto::class);

        $pickupFieldsetData['custom_reference'] = ['invoice' => '123456789'];

        $oneTimePickupDto->setAddress($this->createAddress((int) $pickupFieldsetData['pickup_address']))
            ->setContactPerson($this->createContactPerson((int) $pickupFieldsetData['pickup_address']))
            ->setPickupTime($this->createPickupTime($pickupFieldsetData))
            ->setVolume($this->createVolume($pickupFieldsetData))
            ->setReferences($this->createReferences($pickupFieldsetData));

        return $oneTimePickupDto;
    }

    /**
     * Create address object
     *
     * @param int $addressId
     * @return AddressDto
     */
    private function createAddress(int $addressId): AddressDto
    {
        $pickupAddress = $this->pickupAddrRepository->load($addressId);
        /** @var AddressDto $address */
        $address = $this->abstractDtoBuilder->buildDtoInstance(AddressDto::class);
        $address->setCountryCode($pickupAddress->getAddressCountryCode())
            ->setPostalCode($pickupAddress->getAddressPostalCode())
            ->setCity($pickupAddress->getAddressCity())
            ->setStreet($pickupAddress->getAddressStreet())
            ->setHouseNumber($pickupAddress->getAddressHouseNumber())
            ->setFlatNumber($pickupAddress->getAddressFlatNumber())
            ->setLocationDescription($pickupAddress->getAddressLocationDescription());

        return $address;
    }

    /**
     * Set contact person
     *
     * @param int $addressId
     * @return ContactPersonDto
     */
    private function createContactPerson(int $addressId): ContactPersonDto
    {
        $pickupAddress = $this->pickupAddrRepository->load($addressId);
        /** @var ContactPersonDto $contactPerson */
        $contactPerson = $this->abstractDtoBuilder->buildDtoInstance(ContactPersonDto::class);
        $contactPerson->setFirstName($pickupAddress->getContactFirstName())
            ->setLastName($pickupAddress->getContactLastName())
            ->setEmail($pickupAddress->getContactEmail())
            ->setPhone($this->createPhone([
                'prefix' => $pickupAddress->getContactPhonePrefix(),
                'number' => $pickupAddress->getContactPhoneNumber()
            ]));

        return $contactPerson;
    }

    /**
     * Set pickup time
     *
     * @param mixed $pickup_time
     * @return PickupTimeDto
     * @throws LocalizedException
     */
    private function createPickupTime(mixed $pickup_time): PickupTimeDto
    {
        /** @var PickupTimeDto $pickupTime */
        $pickupTime = $this->abstractDtoBuilder->buildDtoInstance(PickupTimeDto::class);
        if (!strtotime($pickup_time['pickup_time_from']) || !strtotime($pickup_time['pickup_time_to'])) {
            throw new LocalizedException(__('Invalid pickup time format.'));
        }
        $fromDate = $this->timezone->convertConfigTimeToUtc(
            $pickup_time['pickup_time_from'],
            'Y-m-d\TH:i:s.000\Z'
        );
        $toDate = $this->timezone->convertConfigTimeToUtc(
            $pickup_time['pickup_time_to'],
            'Y-m-d\TH:i:s.000\Z'
        );
        return $pickupTime->setFrom($fromDate)
            ->setTo($toDate);
    }

    /**
     * Create volume object
     *
     * @param array $pickupFieldsetData
     * @return VolumeDto
     */
    private function createVolume(array $pickupFieldsetData): VolumeDto
    {
        /** @var VolumeDto $volume */
        $volume = $this->abstractDtoBuilder->buildDtoInstance(VolumeDto::class);
        return $volume->setItemType($pickupFieldsetData['volume_item_type'])
            ->setCount((int) $pickupFieldsetData['volume_count'])
            ->setTotalWeight($this->createTotalWeight($pickupFieldsetData));
    }

    /**
     * Create total weight object
     *
     * @param array $pickupFieldsetData
     * @return TotalWeightDto
     */
    private function createTotalWeight(array $pickupFieldsetData): TotalWeightDto
    {
        /** @var TotalWeightDto $totalWeight */
        $totalWeight = $this->abstractDtoBuilder->buildDtoInstance(TotalWeightDto::class);
        return $totalWeight->setUnit($pickupFieldsetData['volume_weight_unit'])
            ->setAmount((int) $pickupFieldsetData['volume_weight_amount']);
    }
}
