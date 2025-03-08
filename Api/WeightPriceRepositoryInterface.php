<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\WeightPriceInterface;

interface WeightPriceRepositoryInterface
{
    /**
     * Save weight-based price
     *
     * @param WeightPriceInterface&AbstractModel $weightPrice
     * @return WeightPriceInterface
     */
    public function save(WeightPriceInterface $weightPrice): WeightPriceInterface;

    /**
     * Delete weight-based price
     *
     * @param WeightPriceInterface&AbstractModel $weightPrice
     * @return $this
     */
    public function delete(WeightPriceInterface $weightPrice): self;

    /**
     * Load weight-based price
     *
     * @param int $modelId
     * @return WeightPriceInterface
     */
    public function load(int $modelId): WeightPriceInterface;
}
