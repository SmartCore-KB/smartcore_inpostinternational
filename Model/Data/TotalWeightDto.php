<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class TotalWeightDto extends AbstractDto
{
    /**
     * @var int
     */
    public int $amount;
    /**
     * @var string
     */
    public string $unit;

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return $this
     */
    public function setUnit(string $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set amount
     *
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }
}
