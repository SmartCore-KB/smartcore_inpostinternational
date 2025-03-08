<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class OriginDto extends AbstractDto
{
    /**
     * Address of the shipment's origin
     *
     * @var AddressDto|null
     */
    public ?AddressDto $address;

    /**
     * ISO country code of the address
     *
     * @var string|null
     */
    public ?string $countryCode;

    /**
     * Shipping methods available for the shipment
     *
     * @var array<string>|null
     */
    public ?array $shippingMethods;

    /**
     * Get the address of the shipment's origin
     *
     * @return AddressDto
     */
    public function getAddress(): AddressDto
    {
        return $this->address;
    }

    /**
     * Set the address of the shipment's origin
     *
     * @param AddressDto|null $address
     * @return void
     */
    public function setAddress(?AddressDto $address): void
    {
        $this->address = $address;
    }

    /**
     * Get the ISO country code of the origin
     *
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * Set the ISO country code of the origin
     *
     * @param string|null $countryCode
     * @return $this
     */
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Get the shipping methods available for the shipment
     *
     * @return string[]|null
     */
    public function getShippingMethods(): ?array
    {
        return $this->shippingMethods;
    }

    /**
     * Set the shipping methods available for the shipment
     *
     * @param array|null $shippingMethods
     * @return $this
     */
    public function setShippingMethods(?array $shippingMethods): self
    {
        $this->shippingMethods = $shippingMethods;
        return $this;
    }
}
