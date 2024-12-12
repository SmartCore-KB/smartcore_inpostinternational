<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Origin
{
    /**
     * Address of the shipment's origin
     *
     * @var Address
     */
    public Address $address;

    /**
     * Get the address of the shipment's origin
     *
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * Set the address of the shipment's origin
     *
     * @param Address $address
     * @return void
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }
}
