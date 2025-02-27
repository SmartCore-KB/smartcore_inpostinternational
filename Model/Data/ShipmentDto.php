<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class ShipmentDto extends AbstractDto
{
    /**
     * Sender information for the shipment
     *
     * @var SenderDto
     */
    public SenderDto $sender;

    /**
     * Recipient information for the shipment
     *
     * @var RecipientDto
     */
    public RecipientDto $recipient;

    /**
     * Origin address of the shipment
     *
     * @var OriginDto
     */
    public OriginDto $origin;

    /**
     * Destination address for the shipment
     *
     * @var DestinationDto
     */
    public DestinationDto $destination;

    /**
     * Priority level of the shipment (e.g., high, normal)
     *
     * @var string
     */
    public string $priority;

    /**
     * Value-added services associated with the shipment
     *
     * @var ValueAddedServicesDto
     */
    public ValueAddedServicesDto $valueAddedServices;

    /**
     * References associated with the shipment
     *
     * @var ReferencesDto|null
     */
    public ?ReferencesDto $references;

    /**
     * Parcel details for the shipment
     *
     * @var ParcelDto
     */
    public ParcelDto $parcel;

    /**
     * Get the sender information for the shipment
     *
     * @return SenderDto
     */
    public function getSender(): SenderDto
    {
        return $this->sender;
    }

    /**
     * Set the sender information for the shipment
     *
     * @param SenderDto $sender
     * @return $this
     */
    public function setSender(SenderDto $sender): static
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get the recipient information for the shipment
     *
     * @return RecipientDto
     */
    public function getRecipient(): RecipientDto
    {
        return $this->recipient;
    }

    /**
     * Set the recipient information for the shipment
     *
     * @param RecipientDto $recipient
     * @return $this
     */
    public function setRecipient(RecipientDto $recipient): static
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Get the origin address of the shipment
     *
     * @return OriginDto
     */
    public function getOrigin(): OriginDto
    {
        return $this->origin;
    }

    /**
     * Set the origin address of the shipment
     *
     * @param OriginDto $origin
     * @return $this
     */
    public function setOrigin(OriginDto $origin): static
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * Get the destination address for the shipment
     *
     * @return DestinationDto
     */
    public function getDestination(): DestinationDto
    {
        return $this->destination;
    }

    /**
     * Set the destination address for the shipment
     *
     * @param DestinationDto $destination
     * @return $this
     */
    public function setDestination(DestinationDto $destination): static
    {
        $this->destination = $destination;
        return $this;
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
     * @return $this
     */
    public function setPriority(string $priority): static
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get the value-added services associated with the shipment
     *
     * @return ValueAddedServicesDto
     */
    public function getValueAddedServices(): ValueAddedServicesDto
    {
        return $this->valueAddedServices;
    }

    /**
     * Set the value-added services associated with the shipment
     *
     * @param ValueAddedServicesDto|null $valueAddedServices
     * @return $this
     */
    public function setValueAddedServices(?ValueAddedServicesDto $valueAddedServices): static
    {
        $this->valueAddedServices = $valueAddedServices;
        return $this;
    }

    /**
     * Get the references associated with the shipment
     *
     * @return ReferencesDto|null
     */
    public function getReferences(): ?ReferencesDto
    {
        return $this->references;
    }

    /**
     * Set the references associated with the shipment
     *
     * @param ReferencesDto|null $references
     * @return $this
     */
    public function setReferences(?ReferencesDto $references): static
    {
        $this->references = $references;
        return $this;
    }

    /**
     * Get the parcel details for the shipment
     *
     * @return ParcelDto
     */
    public function getParcel(): ParcelDto
    {
        return $this->parcel;
    }

    /**
     * Set the parcel details for the shipment
     *
     * @param ParcelDto $parcel
     * @return $this
     */
    public function setParcel(ParcelDto $parcel): static
    {
        $this->parcel = $parcel;
        return $this;
    }
}
