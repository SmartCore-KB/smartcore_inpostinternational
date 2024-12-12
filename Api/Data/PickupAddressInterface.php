<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface PickupAddressInterface
{

    public const string LABEL = 'label';
    public const string IS_DEFAULT = 'is_default';
    public const string STREET = 'street';
    public const string HOUSE_NUMBER = 'house_number';
    public const string FLAT_NUMBER = 'flat_number';
    public const string POSTAL_CODE = 'postal_code';
    public const string CITY = 'city';
    public const string COUNTRY_CODE = 'country_code';

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Set label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): self;

    /**
     * Get is default
     *
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * Set is default
     *
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): self;

    /**
     * Get street name
     *
     * @return string
     */
    public function getStreet(): string;

    /**
     * Set street name
     *
     * @param string $street
     * @return $this
     */
    public function setStreet(string $street): self;

    /**
     * Get house number
     *
     * @return string
     */
    public function getHouseNumber(): string;

    /**
     * Set house number
     *
     * @param string $houseNumber
     * @return $this
     */
    public function setHouseNumber(string $houseNumber): self;

    /**
     * Get flat number
     *
     * @return string
     */
    public function getFlatNumber(): string;

    /**
     * Set flat number
     *
     * @param string $flatNumber
     * @return $this
     */
    public function setFlatNumber(string $flatNumber): self;

    /**
     * Get postal code
     *
     * @return string
     */
    public function getPostalCode(): string;

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode(string $postalCode): self;

    /**
     * Get city name
     *
     * @return string
     */
    public function getCity(): string;

    /**
     * Set city name
     *
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): self;

    /**
     * Get country code
     *
     * @return string
     */
    public function getCountryCode(): string;

    /**
     * Set country code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): self;
}
