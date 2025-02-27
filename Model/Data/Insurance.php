<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Insurance
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
     * @return void
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
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
     * @return void
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
}
