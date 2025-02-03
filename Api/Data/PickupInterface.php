<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface PickupInterface extends PickupCommonInterface
{
    public const PICKUP_TIME_FROM = 'pickup_time_from';
    public const PICKUP_TIME_TO = 'pickup_time_to';
    public const VOLUME_ITEM_TYPE = 'volume_item_type';
    public const VOLUME_COUNT = 'volume_count';
    public const VOLUME_WEIGHT_AMOUNT = 'volume_weight_amount';
    public const VOLUME_WEIGHT_UNIT = 'volume_weight_unit';
    public const REFERENCES = 'references';
    public const API_RESPONSE = 'api_response';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get pickup time from
     *
     * @return string
     */
    public function getPickupTimeFrom(): string;

    /**
     * Set pickup time from
     *
     * @param string $pickupTimeFrom
     * @return $this
     */
    public function setPickupTimeFrom(string $pickupTimeFrom): static;

    /**
     * Get pickup time to
     *
     * @return string
     */
    public function getPickupTimeTo(): string;

    /**
     * Set pickup time to
     *
     * @param string $pickupTimeTo
     * @return $this
     */
    public function setPickupTimeTo(string $pickupTimeTo): static;

    /**
     * Get volume item type
     *
     * @return string
     */
    public function getVolumeItemType(): string;

    /**
     * Set volume item type
     *
     * @param string $volumeItemType
     * @return $this
     */
    public function setVolumeItemType(string $volumeItemType): static;

    /**
     * Get volume count
     *
     * @return int
     */
    public function getVolumeCount(): int;

    /**
     * Set volume count
     *
     * @param int $volumeCount
     * @return $this
     */
    public function setVolumeCount(int $volumeCount): static;

    /**
     * Get volume weight amount
     *
     * @return float
     */
    public function getVolumeWeightAmount(): float;

    /**
     * Set volume weight amount
     *
     * @param float $volumeWeightAmount
     * @return $this
     */
    public function setVolumeWeightAmount(float $volumeWeightAmount): static;

    /**
     * Get volume weight unit
     *
     * @return string
     */
    public function getVolumeWeightUnit(): string;

    /**
     * Set volume weight unit
     *
     * @param string $volumeWeightUnit
     * @return $this
     */
    public function setVolumeWeightUnit(string $volumeWeightUnit): static;

    /**
     * Get references
     *
     * @return string
     */
    public function getReferences(): string;

    /**
     * Set references
     *
     * @param string $references
     * @return $this
     */
    public function setReferences(string $references): static;

    /**
     * Get api response
     *
     * @return array
     */
    public function getApiResponse(): array;

    /**
     * Set api response
     *
     * @param array<mixed> $apiResponse
     * @return $this
     */
    public function setApiResponse(array $apiResponse): static;

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): static;

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set updated at
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): static;
}
