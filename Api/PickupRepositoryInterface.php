<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\PickupInterface;

interface PickupRepositoryInterface
{
    /**
     * Save Pickup
     *
     * @param PickupInterface&AbstractModel $pickup
     * @return PickupInterface
     */
    public function save(PickupInterface $pickup): PickupInterface;

    /**
     * Delete Pickup
     *
     * @param PickupInterface&AbstractModel $pickup
     * @return $this
     */
    public function delete(PickupInterface $pickup): self;

    /**
     * Load Pickup by id
     *
     * @param int $modelId
     * @return PickupInterface
     */
    public function load(int $modelId): PickupInterface;
}
