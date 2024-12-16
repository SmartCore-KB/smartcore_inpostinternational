<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class AddressDto extends AbstractDto
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
     * @var string|null
     */
    public ?string $postalCode;

    /**
     * City of the address
     *
     * @var string|null
     */
    public ?string $city;

    /**
     * Street name of the address
     *
     * @var string|null
     */
    public ?string $street;

    /**
     * House number of the address
     *
     * @var string|null
     */
    public ?string $houseNumber;

    /**
     * Flat or apartment number of the address (optional)
     *
     * @var string|null
     */
    public ?string $flatNumber = null;

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
     * @return $this
     */
    public function setCountryCode(string $countryCode): static
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Get the postal code of the address
     *
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Set the postal code of the address
     *
     * @param string|null $postalCode
     * @return $this
     */
    public function setPostalCode(?string $postalCode): static
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Get the city of the address
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Set the city of the address
     *
     * @param string|null $city
     * @return $this
     */
    public function setCity(?string $city): static
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get the street name of the address
     *
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Set the street name of the address
     *
     * @param string|null $street
     * @return $this
     */
    public function setStreet(?string $street): static
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Get the house number of the address
     *
     * @return string|null
     */
    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    /**
     * Set the house number of the address
     *
     * @param string|null $houseNumber
     * @return $this
     */
    public function setHouseNumber(?string $houseNumber): static
    {
        $this->houseNumber = $houseNumber;
        return $this;
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
     * @return $this
     */
    public function setFlatNumber(?string $flatNumber): static
    {
        $this->flatNumber = $flatNumber;
        return $this;
    }
}
