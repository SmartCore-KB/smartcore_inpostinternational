<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\PickupCommonInterface;

class PickupCommon extends AbstractModel implements PickupCommonInterface
{

    /**
     * Get street name
     *
     * @return string
     */
    public function getAddressStreet(): string
    {
        return $this->getData(self::ADDRESS_STREET);
    }

    /**
     * Set street name
     *
     * @param string $street
     * @return $this
     */
    public function setAddressStreet(string $street): static
    {
        return $this->setData(self::ADDRESS_STREET, $street);
    }

    /**
     * Get house number
     *
     * @return string
     */
    public function getAddressHouseNumber(): string
    {
        return $this->getData(self::ADDRESS_HOUSE_NUMBER);
    }

    /**
     * Set house number
     *
     * @param string $houseNumber
     * @return $this
     */
    public function setAddressHouseNumber(string $houseNumber): static
    {
        return $this->setData(self::ADDRESS_HOUSE_NUMBER, $houseNumber);
    }

    /**
     * Get flat number
     *
     * @return string
     */
    public function getAddressFlatNumber(): string
    {
        return $this->getData(self::ADDRESS_FLAT_NUMBER);
    }

    /**
     * Set flat number
     *
     * @param string $flatNumber
     * @return $this
     */
    public function setAddressFlatNumber(string $flatNumber): static
    {
        return $this->setData(self::ADDRESS_FLAT_NUMBER, $flatNumber);
    }

    /**
     * Get postal code
     *
     * @return string
     */
    public function getAddressPostalCode(): string
    {
        return $this->getData(self::ADDRESS_POSTAL_CODE);
    }

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setAddressPostalCode(string $postalCode): static
    {
        return $this->setData(self::ADDRESS_POSTAL_CODE, $postalCode);
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getAddressCity(): string
    {
        return $this->getData(self::ADDRESS_CITY);
    }

    /**
     * Set city
     *
     * @param string $city
     * @return $this
     */
    public function setAddressCity(string $city): static
    {
        return $this->setData(self::ADDRESS_CITY, $city);
    }

    /**
     * Get country code
     *
     * @return string
     */
    public function getAddressCountryCode(): string
    {
        return $this->getData(self::ADDRESS_COUNTRY_CODE);
    }

    /**
     * Set country code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setAddressCountryCode(string $countryCode): static
    {
        return $this->setData(self::ADDRESS_COUNTRY_CODE, $countryCode);
    }

    /**
     * Get location description
     *
     * @return string
     */
    public function getAddressLocationDescription(): string
    {
        return $this->getData(self::ADDRESS_LOCATION_DESCRIPTION);
    }

    /**
     * Set location description
     *
     * @param string $locationDescription
     * @return $this
     */
    public function setAddressLocationDescription(string $locationDescription): static
    {
        return $this->setData(self::ADDRESS_LOCATION_DESCRIPTION, $locationDescription);
    }

    /**
     * Get contact first name
     *
     * @return string
     */
    public function getContactFirstName(): string
    {
        return $this->getData(self::CONTACT_FIRST_NAME);
    }

    /**
     * Set contact first name
     *
     * @param string $firstName
     * @return $this
     */
    public function setContactFirstName(string $firstName): static
    {
        return $this->setData(self::CONTACT_FIRST_NAME, $firstName);
    }

    /**
     * Get contact last name
     *
     * @return string
     */
    public function getContactLastName(): string
    {
        return $this->getData(self::CONTACT_LAST_NAME);
    }

    /**
     * Set contact last name
     *
     * @param string $lastName
     * @return $this
     */
    public function setContactLastName(string $lastName): static
    {
        return $this->setData(self::CONTACT_LAST_NAME, $lastName);
    }

    /**
     * Get contact email
     *
     * @return string
     */
    public function getContactEmail(): string
    {
        return $this->getData(self::CONTACT_EMAIL);
    }

    /**
     * Set contact email
     *
     * @param string $email
     * @return $this
     */
    public function setContactEmail(string $email): static
    {
        return $this->setData(self::CONTACT_EMAIL, $email);
    }

    /**
     * Get contact phone prefix
     *
     * @return string
     */
    public function getContactPhonePrefix(): string
    {
        return $this->getData(self::CONTACT_PHONE_PREFIX);
    }

    /**
     * Set contact phone prefix
     *
     * @param string $phonePrefix
     * @return $this
     */
    public function setContactPhonePrefix(string $phonePrefix): static
    {
        return $this->setData(self::CONTACT_PHONE_PREFIX, $phonePrefix);
    }

    /**
     * Get contact phone number
     *
     * @return string
     */
    public function getContactPhoneNumber(): string
    {
        return $this->getData(self::CONTACT_PHONE_NUMBER);
    }

    /**
     * Set contact phone number
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setContactPhoneNumber(string $phoneNumber): static
    {
        return $this->setData(self::CONTACT_PHONE_NUMBER, $phoneNumber);
    }
}
