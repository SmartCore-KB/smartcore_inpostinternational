<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class WeightDto extends AbstractDto
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
     * @return $this
     */
    public function setAmount(float $amount): static
    {
        $this->amount = $amount;
        return $this;
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
     * @return $this
     */
    public function setUnit(string $unit): static
    {
        $this->unit = $unit;
        return $this;
    }
}
