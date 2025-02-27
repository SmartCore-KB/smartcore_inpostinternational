<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class ValueAddedServicesDto extends AbstractDto
{
    /**
     * Insurance associated with the shipment
     *
     * @var InsuranceDto
     */
    public InsuranceDto $insurance;

    /**
     * Get the insurance associated with the shipment
     *
     * @return InsuranceDto
     */
    public function getInsurance(): InsuranceDto
    {
        return $this->insurance;
    }

    /**
     * Set the insurance associated with the shipment
     *
     * @param InsuranceDto $insurance
     * @return void
     */
    public function setInsurance(InsuranceDto $insurance): void
    {
        $this->insurance = $insurance;
    }
}
