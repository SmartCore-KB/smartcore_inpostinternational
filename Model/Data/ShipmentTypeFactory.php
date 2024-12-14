<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use InvalidArgumentException;

class ShipmentTypeFactory
{

    /**
     * ShipmentTypeFactory constructor.
     *
     * @param AddressToPointShipmentDtoFactory $addrToPointFactory
     * @param PointToPointShipmentDtoFactory $pointToPointFactory
     */
    public function __construct(
        private readonly AddressToPointShipmentDtoFactory $addrToPointFactory,
        private readonly PointToPointShipmentDtoFactory   $pointToPointFactory
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
        $factoryMap = [
            'address-to-point' => $this->addrToPointFactory,
            'point-to-point' => $this->pointToPointFactory,
        ];

        if (!isset($factoryMap[$shipmentType])) {
            throw new InvalidArgumentException("Invalid shipment type: $shipmentType");
        }

        return $factoryMap[$shipmentType]->create($data);
    }
}
