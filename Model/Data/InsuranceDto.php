<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class InsuranceDto extends AbstractDto
{
    /**
     * Value of the insurance coverage
     *
     * @var float
     */
    public float $value;

    /**
     * Currency of the insurance value (e.g., USD, EUR)
     *
     * @var string
     */
    public string $currency;

    /**
     * Get the value of the insurance coverage
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Set the value of the insurance coverage
     *
     * @param float $value
     * @return $this
     */
    public function setValue(float $value): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the currency of the insurance value
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Set the currency of the insurance value
     *
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;
        return $this;
    }
}
