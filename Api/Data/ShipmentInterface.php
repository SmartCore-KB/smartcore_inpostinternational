<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface ShipmentInterface
{
    /**
     * Get shipment id
     *
     * @return string
     */
    public function getShipmentId();

    /**
     * Set shipment id
     *
     * @param string $shipmentId
     * @return $this
     */
    public function setShipmentId($shipmentId);

    /**
     * Get sender address
     *
     * @return AddressInterface
     */
    public function getSenderAddress();

    /**
     * Set sender address
     *
     * @param AddressInterface $senderAddress
     * @return $this
     */
    public function setSenderAddress($senderAddress);

    /**
     * Get recipient address
     *
     * @return AddressInterface
     */
    public function getRecipientAddress();

    /**
     * Set recipient address
     *
     * @param AddressInterface $recipientAddress
     * @return $this
     */
    public function setRecipientAddress($recipientAddress);

    /**
     * Get parcels
     *
     * @return ParcelInterface[]
     */
    public function getParcels();

    /**
     * Set parcels
     *
     * @param ParcelInterface[] $parcels
     * @return $this
     */
    public function setParcels(array $parcels);

    /**
     * Get service
     *
     * @return string
     */
    public function getService();

    /**
     * Set service
     *
     * @param string $service
     * @return $this
     */
    public function setService($service);

    /**
     * Get customs declaration
     *
     * @TODO Check if this is correct
     */
    public function getCustomsDeclaration();

    /**
     * Set customs declaration
     *
     * @TODO Check if this is correct
     * @param mixed $customsDeclaration
     * @return $this
     */
    public function setCustomsDeclaration($customsDeclaration);

    /**
     * Get reference
     *
     * @return string|null
     */
    public function getReference();

    /**
     * Set reference
     *
     * @param string|null $reference
     * @return $this
     */
    public function setReference($reference);

    /**
     * Get is insured
     *
     * @return bool
     */
    public function isInsured();

    /**
     * Set is insured
     *
     * @param bool $isInsured
     * @return $this
     */
    public function setIsInsured($isInsured);

    /**
     * Get insurance amount
     *
     * @return float|null
     */
    public function getInsuranceAmount();

    /**
     * Set insurance amount
     *
     * @param float|null $insuranceAmount
     * @return $this
     */
    public function setInsuranceAmount($insuranceAmount);
}
