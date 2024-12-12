<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class ParcelDto extends AbstractDto
{
    /**
     * Type of the parcel (e.g., standard)
     *
     * @var string
     */
    public string $type;

    /**
     * Dimensions of the parcel
     *
     * @var DimensionsDto
     */
    public DimensionsDto $dimensions;

    /**
     * Weight of the parcel
     *
     * @var WeightDto
     */
    public WeightDto $weight;

    /**
     * Label information associated with the parcel
     *
     * @var LabelDto
     */
    public LabelDto $label;

    /**
     * Get the type of the parcel
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the type of the parcel
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the dimensions of the parcel
     *
     * @return DimensionsDto
     */
    public function getDimensions(): DimensionsDto
    {
        return $this->dimensions;
    }

    /**
     * Set the dimensions of the parcel
     *
     * @param DimensionsDto $dimensions
     * @return $this
     */
    public function setDimensions(DimensionsDto $dimensions): static
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * Get the weight of the parcel
     *
     * @return WeightDto
     */
    public function getWeight(): WeightDto
    {
        return $this->weight;
    }

    /**
     * Set the weight of the parcel
     *
     * @param WeightDto $weight
     * @return $this
     */
    public function setWeight(WeightDto $weight): static
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get the label information associated with the parcel
     *
     * @return LabelDto
     */
    public function getLabel(): LabelDto
    {
        return $this->label;
    }

    /**
     * Set the label information associated with the parcel
     *
     * @param LabelDto $label
     * @return $this
     */
    public function setLabel(LabelDto $label): static
    {
        $this->label = $label;
        return $this;
    }
}
