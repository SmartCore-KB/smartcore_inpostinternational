<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class AddressToPointShipment
{
    /**
     * Format of the shipment label (e.g., PDF, ZPL)
     *
     * @var string
     */
    public string $labelFormat;

    /**
     * Shipment details for address-to-point delivery
     *
     * @var Shipment
     */
    public Shipment $shipment;

    /**
     * Get the label format for the shipment
     *
     * @return string
     */
    public function getLabelFormat(): string
    {
        return $this->labelFormat;
    }

    /**
     * Set the label format for the shipment
     *
     * @param string $labelFormat
     * @return void
     */
    public function setLabelFormat(string $labelFormat): void
    {
        $this->labelFormat = $labelFormat;
    }

    /**
     * Get the shipment details for address-to-point delivery
     *
     * @return Shipment
     */
    public function getShipment(): Shipment
    {
        return $this->shipment;
    }

    /**
     * Set the shipment details for address-to-point delivery
     *
     * @param Shipment $shipment
     * @return void
     */
    public function setShipment(Shipment $shipment): void
    {
        $this->shipment = $shipment;
    }
}
