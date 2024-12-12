<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\ShipmentInterface;

interface ShipmentRepositoryInterface
{
    /**
     * Save Parcel Template
     *
     * @param ShipmentInterface&AbstractModel $shipment
     * @return ShipmentInterface
     */
    public function save(ShipmentInterface $shipment): ShipmentInterface;

    /**
     * Delete Parcel Template
     *
     * @param ShipmentInterface&AbstractModel $shipment
     * @return $this
     */
    public function delete(ShipmentInterface $shipment): self;

    /**
     * Load Parcel Template
     *
     * @param int $modelId
     * @return ShipmentInterface
     */
    public function load(int $modelId): ShipmentInterface;
}
