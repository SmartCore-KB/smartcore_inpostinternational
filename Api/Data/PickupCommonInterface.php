<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface PickupCommonInterface
{
    public const ADDRESS_STREET = 'address_street';
    public const ADDRESS_HOUSE_NUMBER = 'address_house_number';
    public const ADDRESS_FLAT_NUMBER = 'address_flat_number';
    public const ADDRESS_POSTAL_CODE = 'address_postal_code';
    public const ADDRESS_CITY = 'address_city';
    public const ADDRESS_COUNTRY_CODE = 'address_country_code';
    public const ADDRESS_LOCATION_DESCRIPTION = 'address_location_description';
    public const CONTACT_FIRST_NAME = 'contact_first_name';
    public const CONTACT_LAST_NAME = 'contact_last_name';
    public const CONTACT_EMAIL = 'contact_email';
    public const CONTACT_PHONE_PREFIX = 'contact_phone_prefix';
    public const CONTACT_PHONE_NUMBER = 'contact_phone_number';

    /**
     * Get contact first name
     *
     * @return string
     */
    public function getContactFirstName(): string;

    /**
     * Set contact first name
     *
     * @param string $firstName
     * @return $this
     */
    public function setContactFirstName(string $firstName): self;

    /**
     * Get contact last name
     *
     * @return string
     */
    public function getContactLastName(): string;

    /**
     * Set contact last name
     *
     * @param string $lastName
     * @return $this
     */
    public function setContactLastName(string $lastName): self;

    /**
     * Get contact email
     *
     * @return string
     */
    public function getContactEmail(): string;

    /**
     * Set contact email
     *
     * @param string $email
     * @return $this
     */
    public function setContactEmail(string $email): self;

    /**
     * Get contact phone prefix
     *
     * @return string
     */
    public function getContactPhonePrefix(): string;

    /**
     * Set contact phone prefix
     *
     * @param string $phonePrefix
     * @return $this
     */
    public function setContactPhonePrefix(string $phonePrefix): self;

    /**
     * Get contact phone number
     *
     * @return string
     */
    public function getContactPhoneNumber(): string;

    /**
     * Set contact phone number
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setContactPhoneNumber(string $phoneNumber): self;

    /**
     * Get street name
     *
     * @return string
     */
    public function getAddressStreet(): string;

    /**
     * Set street name
     *
     * @param string $street
     * @return $this
     */
    public function setAddressStreet(string $street): self;

    /**
     * Get house number
     *
     * @return string
     */
    public function getAddressHouseNumber(): string;

    /**
     * Set house number
     *
     * @param string $houseNumber
     * @return $this
     */
    public function setAddressHouseNumber(string $houseNumber): self;

    /**
     * Get flat number
     *
     * @return string
     */
    public function getAddressFlatNumber(): string;

    /**
     * Set flat number
     *
     * @param string $flatNumber
     * @return $this
     */
    public function setAddressFlatNumber(string $flatNumber): self;

    /**
     * Get postal code
     *
     * @return string
     */
    public function getAddressPostalCode(): string;

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setAddressPostalCode(string $postalCode): self;

    /**
     * Get city name
     *
     * @return string
     */
    public function getAddressCity(): string;

    /**
     * Set city name
     *
     * @param string $city
     * @return $this
     */
    public function setAddressCity(string $city): self;

    /**
     * Get country code
     *
     * @return string
     */
    public function getAddressCountryCode(): string;

    /**
     * Set country code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setAddressCountryCode(string $countryCode): self;

    /**
     * Get location description
     *
     * @return string
     */
    public function getAddressLocationDescription(): string;

    /**
     * Set location description
     *
     * @param string $locationDescription
     * @return $this
     */
    public function setAddressLocationDescription(string $locationDescription): self;
}
