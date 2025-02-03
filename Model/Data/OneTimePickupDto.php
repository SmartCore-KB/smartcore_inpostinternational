<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\Pickup;
use Smartcore\InPostInternational\Model\PickupFactory;

class OneTimePickupDto extends AbstractDto
{
    /**
     * OneTimePickupDto constructor.
     *
     * @param PickupFactory $pickupFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        private readonly PickupFactory $pickupFactory,
        Context                          $context,
        Registry                         $registry,
        AbstractResource                 $resource = null,
        AbstractDb                       $resourceCollection = null
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection);
    }

    /**
     * Get address
     *
     * @return AddressDto
     */
    public function getAddress(): AddressDto
    {
        return $this->getData('address');
    }

    /**
     * Set address
     *
     * @param AddressDto $address
     * @return self
     */
    public function setAddress(AddressDto $address): self
    {
        $this->setData('address', $address);
        return $this;
    }

    /**
     * Get contact person
     *
     * @return ContactPersonDto
     */
    public function getContactPerson(): ContactPersonDto
    {
        return $this->getData('contactPerson');
    }

    /**
     * Set contact person
     *
     * @param ContactPersonDto $contactPerson
     * @return self
     */
    public function setContactPerson(ContactPersonDto $contactPerson): self
    {
        $this->setData('contactPerson', $contactPerson);
        return $this;
    }

    /**
     * Get pickup time
     *
     * @return PickupTimeDto
     */
    public function getPickupTime(): PickupTimeDto
    {
        return $this->getData('pickupTime');
    }

    /**
     * Set pickup time
     *
     * @param PickupTimeDto $pickupTime
     * @return self
     */
    public function setPickupTime(PickupTimeDto $pickupTime): self
    {
        $this->setData('pickupTime', $pickupTime);
        return $this;
    }

    /**
     * Get volume
     *
     * @return VolumeDto
     */
    public function getVolume(): VolumeDto
    {
        return $this->getData('volume');
    }

    /**
     * Set volume
     *
     * @param VolumeDto $volume
     * @return self
     */
    public function setVolume(VolumeDto $volume): self
    {
        $this->setData('volume', $volume);
        return $this;
    }

    /**
     * Get references
     *
     * @return ReferencesDto|null
     */
    public function getReferences(): ?ReferencesDto
    {
        return $this->getData('references');
    }

    /**
     * Set references
     *
     * @param ReferencesDto|null $references
     * @return self
     */
    public function setReferences(?ReferencesDto $references): self
    {
        $this->setData('references', $references);
        return $this;
    }

    /**
     * Convert DTO to Pickup model
     *
     * @return Pickup
     */
    public function toDbModel(): Pickup
    {
        $pickup = $this->pickupFactory->create();
        $address = $this->getAddress();
        $contactPerson = $this->getContactPerson();
        $pickupTime = $this->getPickupTime();
        $volume = $this->getVolume();
        $references = $this->getReferences();

        $pickup
            ->setAddressStreet($address->getStreet())
            ->setAddressCity($address->getCity())
            ->setAddressPostalCode($address->getPostalCode())
            ->setAddressCountryCode($address->getCountryCode())
            ->setAddressHouseNumber($address->getHouseNumber())
            ->setAddressFlatNumber($address->getFlatNumber())
            ->setAddressLocationDescription($address->getLocationDescription())
            ->setContactFirstName($contactPerson->getFirstName())
            ->setContactLastName($contactPerson->getLastName())
            ->setContactEmail($contactPerson->getEmail())
            ->setContactPhonePrefix($contactPerson->getPhone()->getPrefix())
            ->setContactPhoneNumber($contactPerson->getPhone()->getNumber())
            ->setPickupTimeFrom($pickupTime->getFrom())
            ->setPickupTimeTo($pickupTime->getTo())
            ->setVolumeItemType($volume->getItemType())
            ->setVolumeCount($volume->getCount())
            ->setVolumeWeightAmount($volume->getTotalWeight()->getAmount())
            ->setVolumeWeightUnit($volume->getTotalWeight()->getUnit());

        if ($references) {
            $pickup->setReferences(json_encode(json_encode($references->getCustom())));
        }

        return $pickup;
    }
}
