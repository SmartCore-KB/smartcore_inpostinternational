<?php
namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\ParcelTemplateInterface;
use Smartcore\InPostInternational\Model\ResourceModel\ParcelTemplate as ParcelTemplateResourceModel;

class ParcelTemplate extends AbstractModel implements ParcelTemplateInterface
{
    /**
     * Parcel Template model constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ParcelTemplateResourceModel::class);
    }

    /**
     * Get entity id
     *
     * @return int|null
     */
    public function getEntityId(): ?int
    {
        return $this->_getData('entity_id');
    }

    /**
     * Set entity id
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId): static
    {
        return $this->setData('entity_id', $entityId);
    }

    /**
     * Get label
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->getData(self::LABEL);
    }

    /**
     * Set label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): static
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * Get is default
     *
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->getData(self::IS_DEFAULT);
    }

    /**
     * Set is default
     *
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): static
    {
        return $this->setData(self::IS_DEFAULT, $isDefault);
    }

    /**
     * Get length
     *
     * @return float
     */
    public function getLength(): float
    {
        return $this->getData(self::LENGTH);
    }

    /**
     * Set length
     *
     * @param float $length
     * @return $this
     */
    public function setLength(float $length): static
    {
        return $this->setData(self::LENGTH, $length);
    }

    /**
     * Get width
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->getData(self::WIDTH);
    }

    /**
     * Set width
     *
     * @param float $width
     * @return $this
     */
    public function setWidth(float $width): static
    {
        return $this->setData(self::WIDTH, $width);
    }

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight(): float
    {
        return $this->getData(self::HEIGHT);
    }

    /**
     * Set height
     *
     * @param float $height
     * @return $this
     */
    public function setHeight(float $height): static
    {
        return $this->setData(self::HEIGHT, $height);
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float
    {
        return $this->getData(self::WEIGHT);
    }

    /**
     * Set weight
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight(float $weight): static
    {
        return $this->setData(self::WEIGHT, $weight);
    }

    /**
     * Get comment
     *
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Set comment
     *
     * @param string|null $comment
     * @return $this
     */
    public function setComment(?string $comment): static
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Get barcode
     *
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->getData(self::BARCODE);
    }

    /**
     * Set barcode
     *
     * @param string|null $barcode
     * @return $this
     */
    public function setBarcode(?string $barcode): static
    {
        return $this->setData(self::BARCODE, $barcode);
    }
}
