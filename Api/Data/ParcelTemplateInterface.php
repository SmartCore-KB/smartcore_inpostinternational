<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface ParcelTemplateInterface
{
    public const ENTITY_ID = 'entity_id';
    public const TYPE = 'type';
    public const LABEL = 'label';
    public const IS_DEFAULT = 'is_default';
    public const LENGTH = 'length';
    public const WIDTH = 'width';
    public const HEIGHT = 'height';
    public const WEIGHT = 'weight';
    public const COMMENT = 'comment';
    public const BARCODE = 'barcode';
    public const DIMENSION_UNIT = 'dimension_unit';
    public const WEIGHT_UNIT = 'weight_unit';

    /**
     * Get entity id
     *
     * @return int|null
     */
    public function getEntityId(): ?int;

    /**
     * Set entity id
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId(int $entityId): self;

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * Set type
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self;

    /**
     * Get label
     *
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * Set label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): self;

    /**
     * Get is default
     *
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * Set is default
     *
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): self;

    /**
     * Get length
     *
     * @return float
     */
    public function getLength(): float;

    /**
     * Set length
     *
     * @param float $length
     * @return $this
     */
    public function setLength(float $length): self;

    /**
     * Get width
     *
     * @return float
     */
    public function getWidth(): float;

    /**
     * Set width
     *
     * @param float $width
     * @return $this
     */
    public function setWidth(float $width): self;

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight(): float;

    /**
     * Set height
     *
     * @param float $height
     * @return $this
     */
    public function setHeight(float $height): self;

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float;

    /**
     * Set weight
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight(float $weight): self;

    /**
     * Get comment
     *
     * @return string|null
     */
    public function getComment(): ?string;

    /**
     * Set comment
     *
     * @param string|null $comment
     * @return $this
     */
    public function setComment(?string $comment): self;

    /**
     * Get barcode
     *
     * @return string|null
     */
    public function getBarcode(): ?string;

    /**
     * Set barcode
     *
     * @param string|null $barcode
     * @return $this
     */
    public function setBarcode(?string $barcode): self;

    /**
     * Get dimension unit
     *
     * @return string|null
     */
    public function getDimensionUnit(): ?string;

    /**
     * Set dimension unit
     *
     * @param string|null $dimensionUnit
     * @return $this
     */
    public function setDimensionUnit(?string $dimensionUnit): self;

    /**
     * Get weight unit
     *
     * @return string|null
     */
    public function getWeightUnit(): ?string;

    /**
     * Set weight unit
     *
     * @param string|null $weightUnit
     * @return $this
     */
    public function setWeightUnit(?string $weightUnit): self;
}
