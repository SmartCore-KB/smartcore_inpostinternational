<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Weight
{
    /**
     * Amount of the weight
     *
     * @var float
     */
    public float $amount;

    /**
     * Unit of the weight (e.g., kg, lb)
     *
     * @var string
     */
    public string $unit;

    /**
     * Get the amount of the weight
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the amount of the weight
     *
     * @param float $amount
     * @return void
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get the unit of the weight
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Set the unit of the weight
     *
     * @param string $unit
     * @return void
     */
    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}
