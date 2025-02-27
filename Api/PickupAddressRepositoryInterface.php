<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\PickupAddressInterface;

interface PickupAddressRepositoryInterface
{
    /**
     * Save Pickup address
     *
     * @param PickupAddressInterface&AbstractModel $pickupAddress
     * @return PickupAddressInterface
     */
    public function save(PickupAddressInterface $pickupAddress): PickupAddressInterface;

    /**
     * Delete Pickup address
     *
     * @param PickupAddressInterface&AbstractModel $pickupAddress
     * @return $this
     */
    public function delete(PickupAddressInterface $pickupAddress): self;

    /**
     * Load Pickup address by id
     *
     * @param int $modelId
     * @return PickupAddressInterface
     */
    public function load(int $modelId): PickupAddressInterface;
}
