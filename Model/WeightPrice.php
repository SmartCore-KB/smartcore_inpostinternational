<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\WeightPriceInterface;

class WeightPrice extends AbstractModel implements WeightPriceInterface
{
    /**
     * WeightPrice constructor
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\WeightPrice::class);
    }

    /**
     * Get weight from
     *
     * @return float
     */
    public function getWeightFrom(): float
    {
        return (float) $this->getData(self::WEIGHT_FROM);
    }

    /**
     * Set weight from
     *
     * @param float $weightFrom
     * @return self
     */
    public function setWeightFrom(float $weightFrom): WeightPriceInterface
    {
        return $this->setData(self::WEIGHT_FROM, $weightFrom);
    }

    /**
     * Get weight to
     *
     * @return float|null
     */
    public function getWeightTo(): ?float
    {
        return (float) $this->getData(self::WEIGHT_TO);
    }

    /**
     * Set weight to
     *
     * @param float|null $weightTo
     * @return self
     */
    public function setWeightTo(?float $weightTo): WeightPriceInterface
    {
        return $this->setData(self::WEIGHT_TO, $weightTo);
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return (float) $this->getData(self::PRICE);
    }

    /**
     * Set price
     *
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): WeightPriceInterface
    {
        return $this->setData(self::PRICE, $price);
    }
}
