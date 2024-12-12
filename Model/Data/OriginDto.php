<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class OriginDto extends AbstractDto
{
    /**
     * Address of the shipment's origin
     *
     * @var AddressDto
     */
    public AddressDto $address;

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
     * @param AddressDto $address
     * @return void
     */
    public function setAddress(AddressDto $address): void
    {
        $this->address = $address;
    }
}
