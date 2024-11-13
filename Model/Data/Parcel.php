<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Parcel
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
     * @var Dimensions
     */
    public Dimensions $dimensions;

    /**
     * Weight of the parcel
     *
     * @var Weight
     */
    public Weight $weight;

    /**
     * Label information associated with the parcel
     *
     * @var Label
     */
    public Label $label;

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
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get the dimensions of the parcel
     *
     * @return Dimensions
     */
    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    /**
     * Set the dimensions of the parcel
     *
     * @param Dimensions $dimensions
     * @return void
     */
    public function setDimensions(Dimensions $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    /**
     * Get the weight of the parcel
     *
     * @return Weight
     */
    public function getWeight(): Weight
    {
        return $this->weight;
    }

    /**
     * Set the weight of the parcel
     *
     * @param Weight $weight
     * @return void
     */
    public function setWeight(Weight $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * Get the label information associated with the parcel
     *
     * @return Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }

    /**
     * Set the label information associated with the parcel
     *
     * @param Label $label
     * @return void
     */
    public function setLabel(Label $label): void
    {
        $this->label = $label;
    }
}
