<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Shipment
{
    /**
     * Sender information for the shipment
     *
     * @var Sender
     */
    public Sender $sender;

    /**
     * Recipient information for the shipment
     *
     * @var Recipient
     */
    public Recipient $recipient;

    /**
     * Origin address of the shipment
     *
     * @var Origin
     */
    public Origin $origin;

    /**
     * Destination address for the shipment
     *
     * @var Destination
     */
    public Destination $destination;

    /**
     * Priority level of the shipment (e.g., high, normal)
     *
     * @var string
     */
    public string $priority;

    /**
     * Value-added services associated with the shipment
     *
     * @var ValueAddedServices
     */
    public ValueAddedServices $valueAddedServices;

    /**
     * References associated with the shipment
     *
     * @var References
     */
    public References $references;

    /**
     * Parcel details for the shipment
     *
     * @var Parcel
     */
    public Parcel $parcel;

    /**
     * Get the sender information for the shipment
     *
     * @return Sender
     */
    public function getSender(): Sender
    {
        return $this->sender;
    }

    /**
     * Set the sender information for the shipment
     *
     * @param Sender $sender
     * @return void
     */
    public function setSender(Sender $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * Get the recipient information for the shipment
     *
     * @return Recipient
     */
    public function getRecipient(): Recipient
    {
        return $this->recipient;
    }

    /**
     * Set the recipient information for the shipment
     *
     * @param Recipient $recipient
     * @return void
     */
    public function setRecipient(Recipient $recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * Get the origin address of the shipment
     *
     * @return Origin
     */
    public function getOrigin(): Origin
    {
        return $this->origin;
    }

    /**
     * Set the origin address of the shipment
     *
     * @param Origin $origin
     * @return void
     */
    public function setOrigin(Origin $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * Get the destination address for the shipment
     *
     * @return Destination
     */
    public function getDestination(): Destination
    {
        return $this->destination;
    }

    /**
     * Set the destination address for the shipment
     *
     * @param Destination $destination
     * @return void
     */
    public function setDestination(Destination $destination): void
    {
        $this->destination = $destination;
    }

    /**
     * Get the priority level of the shipment
     *
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * Set the priority level of the shipment
     *
     * @param string $priority
     * @return void
     */
    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * Get the value-added services associated with the shipment
     *
     * @return ValueAddedServices
     */
    public function getValueAddedServices(): ValueAddedServices
    {
        return $this->valueAddedServices;
    }

    /**
     * Set the value-added services associated with the shipment
     *
     * @param ValueAddedServices $valueAddedServices
     * @return void
     */
    public function setValueAddedServices(ValueAddedServices $valueAddedServices): void
    {
        $this->valueAddedServices = $valueAddedServices;
    }

    /**
     * Get the references associated with the shipment
     *
     * @return References
     */
    public function getReferences(): References
    {
        return $this->references;
    }

    /**
     * Set the references associated with the shipment
     *
     * @param References $references
     * @return void
     */
    public function setReferences(References $references): void
    {
        $this->references = $references;
    }

    /**
     * Get the parcel details for the shipment
     *
     * @return Parcel
     */
    public function getParcel(): Parcel
    {
        return $this->parcel;
    }

    /**
     * Set the parcel details for the shipment
     *
     * @param Parcel $parcel
     * @return void
     */
    public function setParcel(Parcel $parcel): void
    {
        $this->parcel = $parcel;
    }
}
