<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface ParcelTemplateInterface
{
    public const string ENTITY_ID = 'entity_id';
    public const string LABEL = 'label';
    public const string IS_DEFAULT = 'is_default';
    public const string LENGTH = 'length';
    public const string WIDTH = 'width';
    public const string HEIGHT = 'height';
    public const string WEIGHT = 'weight';
    public const string COMMENT = 'comment';
    public const string BARCODE = 'barcode';

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
    public function setEntityId(int $entityId): static;

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
    public function setLabel(string $label): static;

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
    public function setIsDefault(bool $isDefault): static;

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
    public function setLength(float $length): static;

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
    public function setWidth(float $width): static;

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
    public function setHeight(float $height): static;

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
    public function setWeight(float $weight): static;

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
    public function setComment(?string $comment): static;

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
    public function setBarcode(?string $barcode): static;
}
