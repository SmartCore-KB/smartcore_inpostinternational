<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface WeightPriceInterface
{
    public const ENTITY_ID = 'entity_id';
    public const WEIGHT_FROM = 'weight_from';
    public const WEIGHT_TO = 'weight_to';
    public const PRICE = 'price';

    /**
     * Get weight from
     *
     * @return float
     */
    public function getWeightFrom(): float;

    /**
     * Set weight from
     *
     * @param float $weightFrom
     * @return $this
     */
    public function setWeightFrom(float $weightFrom): self;

    /**
     * Get weight from
     *
     * @return float|null
     */
    public function getWeightTo(): ?float;

    /**
     * Set weight from
     *
     * @param float|null $weightTo
     * @return $this
     */
    public function setWeightTo(?float $weightTo): self;

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice(): float;

    /**
     * Set price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): self;
}
