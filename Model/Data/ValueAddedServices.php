<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class ValueAddedServices
{
    /**
     * Insurance associated with the shipment
     *
     * @var Insurance
     */
    public Insurance $insurance;

    /**
     * Get the insurance associated with the shipment
     *
     * @return Insurance
     */
    public function getInsurance(): Insurance
    {
        return $this->insurance;
    }

    /**
     * Set the insurance associated with the shipment
     *
     * @param Insurance $insurance
     * @return void
     */
    public function setInsurance(Insurance $insurance): void
    {
        $this->insurance = $insurance;
    }
}
