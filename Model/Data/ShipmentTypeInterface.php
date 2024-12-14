<?php

namespace Smartcore\InPostInternational\Model\Data;

use Smartcore\InPostInternational\Model\Shipment;

interface ShipmentTypeInterface
{
    public const string LABEL_FORMAT = 'labelFormat';
    public const string SHIPMENT = 'shipment';

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
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = []);
}
