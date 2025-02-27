<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Address
{
    /**
     * ISO country code of the address
     *
     * @var string
     */
    public string $countryCode;

    /**
     * Postal code of the address
     *
     * @var string
     */
    public string $postalCode;

    /**
     * City of the address
     *
     * @var string
     */
    public string $city;

    /**
     * Street name of the address
     *
     * @var string
     */
    public string $street;

    /**
     * House number of the address
     *
     * @var string
     */
    public string $houseNumber;

    /**
     * Flat or apartment number of the address (optional)
     *
     * @var string|null
     */
    public ?string $flatNumber;

    /**
     * Get the country code of the address
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * Set the country code of the address
     *
     * @param string $countryCode
     * @return void
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Get the postal code of the address
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Set the postal code of the address
     *
     * @param string $postalCode
     * @return void
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * Get the city of the address
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Set the city of the address
     *
     * @param string $city
     * @return void
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * Get the street name of the address
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Set the street name of the address
     *
     * @param string $street
     * @return void
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * Get the house number of the address
     *
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * Set the house number of the address
     *
     * @param string $houseNumber
     * @return void
     */
    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * Get the flat or apartment number of the address, if applicable
     *
     * @return string|null
     */
    public function getFlatNumber(): ?string
    {
        return $this->flatNumber;
    }

    /**
     * Set the flat or apartment number of the address, if applicable
     *
     * @param string|null $flatNumber
     * @return void
     */
    public function setFlatNumber(?string $flatNumber): void
    {
        $this->flatNumber = $flatNumber;
    }
}
