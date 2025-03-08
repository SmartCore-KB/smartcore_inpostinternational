<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smartcore\InPostInternational\Model\Data\ShipmentTypeInterface;

class ShipmentTypesList implements OptionSourceInterface
{
    /**
     * Shipment types constructor
     *
     * @param array $shipmentTypes
     */
    public function __construct(
        private readonly array $shipmentTypes = []
    ) {
    }

    /**
     * Get shipment types list
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $options = [];

        foreach ($this->shipmentTypes as $shipmentType) {
            /** @var ShipmentTypeInterface $shipmentType */
            $options[] = [
                'value' => $shipmentType->getEndpoint(),
                'label' => __($shipmentType->getLabel())->render(),
            ];
        }

        return $options;
    }
}
