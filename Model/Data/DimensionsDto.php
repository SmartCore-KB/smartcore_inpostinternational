<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class DimensionsDto extends AbstractDto
{
    /**
     * Length of the package
     *
     * @var float
     */
    public float $length;

    /**
     * Width of the package
     *
     * @var float
     */
    public float $width;

    /**
     * Height of the package
     *
     * @var float
     */
    public float $height;

    /**
     * Unit of measurement for the dimensions (e.g., cm, in)
     *
     * @var string
     */
    public string $unit;

    /**
     * Get the length of the package
     *
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * Set the length of the package
     *
     * @param float $length
     * @return $this
     */
    public function setLength(float $length): static
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Get the width of the package
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set the width of the package
     *
     * @param float $width
     * @return $this
     */
    public function setWidth(float $width): static
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Get the height of the package
     *
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * Set the height of the package
     *
     * @param float $height
     * @return $this
     */
    public function setHeight(float $height): static
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Get the unit of measurement for the dimensions
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Set the unit of measurement for the dimensions
     *
     * @param string $unit
     * @return $this
     */
    public function setUnit(string $unit): static
    {
        $this->unit = $unit;
        return $this;
    }
}
