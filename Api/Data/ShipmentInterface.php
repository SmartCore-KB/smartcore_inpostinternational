<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface ShipmentInterface
{
    /**
     * Shipment entity ID
     *
     * @var string
     */
    public const ENTITY_ID = 'entity_id';

    /**
     * Get shipment id
     *
     * @return string
     */
    public function getShipmentId(): string;

    /**
     * Set shipment id
     *
     * @param string $shipmentId
     * @return $this
     */
    public function setShipmentId(string $shipmentId): self;

    /**
     * Get sender address
     *
     * @return AddressInterface
     */
    public function getSenderAddress(): AddressInterface;

    /**
     * Set sender address
     *
     * @param AddressInterface $senderAddress
     * @return $this
     */
    public function setSenderAddress(AddressInterface $senderAddress): self;

    /**
     * Get recipient address
     *
     * @return AddressInterface
     */
    public function getRecipientAddress(): AddressInterface;

    /**
     * Set recipient address
     *
     * @param AddressInterface $recipientAddress
     * @return $this
     */
    public function setRecipientAddress(AddressInterface $recipientAddress): self;

    /**
     * Get parcels
     *
     * @return ParcelInterface[]
     */
    public function getParcels(): array;

    /**
     * Set parcels
     *
     * @param ParcelInterface[] $parcels
     * @return $this
     */
    public function setParcels(array $parcels): self;

    /**
     * Get service type
     *
     * @return string
     */
    public function getService(): string;

    /**
     * Set service type
     *
     * @param string $service
     * @return $this
     */
    public function setService(string $service): self;

    /**
     * Get customs declaration
     *
     * @TODO Check if this is correct
     * @return mixed
     */
    public function getCustomsDeclaration();

    /**
     * Set customs declaration
     *
     * @TODO Check if this is correct
     * @param mixed $customsDeclaration
     * @return $this
     */
    public function setCustomsDeclaration($customsDeclaration): self;

    /**
     * Get reference
     *
     * @return string|null
     */
    public function getReference(): ?string;

    /**
     * Set reference
     *
     * @param string|null $reference
     * @return $this
     */
    public function setReference(?string $reference): self;

    /**
     * Get if shipment is insured
     *
     * @return bool
     */
    public function isInsured(): bool;

    /**
     * Set if shipment is insured
     *
     * @param bool $isInsured
     * @return $this
     */
    public function setIsInsured(bool $isInsured): self;

    /**
     * Get insurance amount
     *
     * @return float|null
     */
    public function getInsuranceAmount(): ?float;

    /**
     * Set insurance amount
     *
     * @param float|null $insuranceAmount
     * @return $this
     */
    public function setInsuranceAmount(?float $insuranceAmount): self;
}
