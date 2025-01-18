<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Smartcore\InPostInternational\Model\InPostShipment;

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
     * Get the label for the shipment type
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Convert shipment data to database model
     *
     * @return InPostShipment
     */
    public function toDbModel(): InPostShipment;

    /**
     * Create origin object
     *
     * @param array<string,mixed> $shipmentFieldsetData
     * @return OriginDto
     */
    public function createOrigin(array $shipmentFieldsetData): OriginDto;

    /**
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = []);
}
