<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class OneTimePickupDto extends AbstractDto
{

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
}
