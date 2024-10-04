<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Sales\Api\Data\ShipmentInterface;

interface ShipmentManagementInterface
{
    /**
     * Create shipment
     *
     * @param ShipmentInterface $shipment
     * @return mixed
     */
    public function createShipment(ShipmentInterface $shipment);

    /**
     * Get label
     *
     * @param string $shipmentId
     * @return mixed
     */
    public function getLabel(string $shipmentId);

    /**
     * Cancel shipment
     *
     * @param string $shipmentId
     * @return mixed
     */
    public function cancelShipment(string $shipmentId);
}
