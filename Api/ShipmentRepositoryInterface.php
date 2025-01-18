<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\InPostShipmentInterface;

interface ShipmentRepositoryInterface
{
    /**
     * Save Parcel Template
     *
     * @param InPostShipmentInterface&AbstractModel $shipment
     * @return InPostShipmentInterface
     */
    public function save(InPostShipmentInterface $shipment): InPostShipmentInterface;

    /**
     * Delete Parcel Template
     *
     * @param InPostShipmentInterface&AbstractModel $shipment
     * @return $this
     */
    public function delete(InPostShipmentInterface $shipment): self;

    /**
     * Load Parcel Template
     *
     * @param int $modelId
     * @return InPostShipmentInterface
     */
    public function load(int $modelId): InPostShipmentInterface;
}
