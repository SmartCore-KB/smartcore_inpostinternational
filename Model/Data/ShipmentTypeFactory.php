<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use InvalidArgumentException;
use Smartcore\InPostInternational\Model\ShipmentFactory;

class ShipmentTypeFactory
{
    private const array SHIPMENT_TYPE_CLASS_MAP = [
        'address-to-point' => AddressToPointShipmentDto::class,
        'point-to-point' => PointToPointShipmentDto::class,
    ];

    /**
     * ShipmentTypeFactory constructor.
     *
     * @param ShipmentFactory $shipmentFactory
     */
    public function __construct(
        private readonly ShipmentFactory $shipmentFactory
    ) {
    }

    /**
     * Create a new shipment instance
     *
     * @param string $shipmentType
     * @param array $data
     * @return ShipmentTypeInterface
     * @throws InvalidArgumentException
     */
    public function create(string $shipmentType, array $data = []): ShipmentTypeInterface
    {
        if (!isset(self::SHIPMENT_TYPE_CLASS_MAP[$shipmentType])) {
            throw new InvalidArgumentException("Invalid shipment type: $shipmentType");
        }

        $className = self::SHIPMENT_TYPE_CLASS_MAP[$shipmentType];

        return new $className($this->shipmentFactory, ...$data);
    }
}
