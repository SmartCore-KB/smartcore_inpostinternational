<?php

namespace Smartcore\InPostInternational\Model\Data;

use Smartcore\InPostInternational\Model\Shipment;

interface ShipmentTypeInterface
{
    /**
     * Get API endpoint for shipment type
     *
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * Convert shipment data to database model
     *
     * @return Shipment
     */
    public function toDbModel(): Shipment;

    /**
     * Convert object to array
     *
     * @return array<mixed>
     */
    public function toArray(): array;
}
