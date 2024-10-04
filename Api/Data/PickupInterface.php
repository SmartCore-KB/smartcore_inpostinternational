<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface PickupInterface
{
    /**
     * Get address
     *
     * @return string
     */
    public function getAddress();

    /**
     * Set address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * Get contact person
     *
     * @return string
     */
    public function getContactPerson();

    /**
     * Set contact person
     *
     * @param string $contactPerson
     * @return $this
     */
    public function setContactPerson($contactPerson);

    /**
     * Get pickup date
     *
     * @return string
     */
    public function getPickupDate();

    /**
     * Set pickup date
     *
     * @param string $pickupDate
     * @return $this
     */
    public function setPickupDate($pickupDate);
}
