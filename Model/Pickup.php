<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Smartcore\InPostInternational\Api\Data\PickupInterface;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup as ResourceModel;

class Pickup extends PickupCommon implements PickupInterface
{

    /**
     * @var string
     */
    protected $_eventPrefix = 'inpostinternational_pickup_model';

    /**
     * Initialize Pickup
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Get pickup time from
     *
     * @return string
     */
    public function getPickupTimeFrom(): string
    {
        return $this->getData(self::PICKUP_TIME_FROM);
    }

    /**
     * Set pickup time from
     *
     * @param string $pickupTimeFrom
     * @return $this
     */
    public function setPickupTimeFrom(string $pickupTimeFrom): static
    {
        return $this->setData(self::PICKUP_TIME_FROM, $pickupTimeFrom);
    }

    /**
     * Get pickup time to
     *
     * @return string
     */
    public function getPickupTimeTo(): string
    {
        return $this->getData(self::PICKUP_TIME_TO);
    }

    /**
     * Set pickup time to
     *
     * @param string $pickupTimeTo
     * @return $this
     */
    public function setPickupTimeTo(string $pickupTimeTo): static
    {
        return $this->setData(self::PICKUP_TIME_TO, $pickupTimeTo);
    }

    /**
     * Get volume item type
     *
     * @return string
     */
    public function getVolumeItemType(): string
    {
        return $this->getData(self::VOLUME_ITEM_TYPE);
    }

    /**
     * Set volume item type
     *
     * @param string $volumeItemType
     * @return $this
     */
    public function setVolumeItemType(string $volumeItemType): static
    {
        return $this->setData(self::VOLUME_ITEM_TYPE, $volumeItemType);
    }

    /**
     * Get volume count
     *
     * @return int
     */
    public function getVolumeCount(): int
    {
        return (int)$this->getData(self::VOLUME_COUNT);
    }

    /**
     * Set volume count
     *
     * @param int $volumeCount
     * @return $this
     */
    public function setVolumeCount(int $volumeCount): static
    {
        return $this->setData(self::VOLUME_COUNT, $volumeCount);
    }

    /**
     * Get volume weight amount
     *
     * @return float
     */
    public function getVolumeWeightAmount(): float
    {
        return (float)$this->getData(self::VOLUME_WEIGHT_AMOUNT);
    }

    /**
     * Set volume weight amount
     *
     * @param float $volumeWeightAmount
     * @return $this
     */
    public function setVolumeWeightAmount(float $volumeWeightAmount): static
    {
        return $this->setData(self::VOLUME_WEIGHT_AMOUNT, $volumeWeightAmount);
    }

    /**
     * Get volume weight unit
     *
     * @return string
     */
    public function getVolumeWeightUnit(): string
    {
        return $this->getData(self::VOLUME_WEIGHT_UNIT);
    }

    /**
     * Set volume weight unit
     *
     * @param string $volumeWeightUnit
     * @return $this
     */
    public function setVolumeWeightUnit(string $volumeWeightUnit): static
    {
        return $this->setData(self::VOLUME_WEIGHT_UNIT, $volumeWeightUnit);
    }

    /**
     * Get references
     *
     * @return string
     */
    public function getReferences(): string
    {
        return $this->getData(self::REFERENCES);
    }

    /**
     * Set references
     *
     * @param string $references
     * @return $this
     */
    public function setReferences(string $references): static
    {
        return $this->setData(self::REFERENCES, $references);
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): static
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set updated at
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): static
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
