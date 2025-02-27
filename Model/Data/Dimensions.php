<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Dimensions
{
    /**
     * Length of the package
     *
     * @var int
     */
    public int $length;

    /**
     * Width of the package
     *
     * @var int
     */
    public int $width;

    /**
     * Height of the package
     *
     * @var int
     */
    public int $height;

    /**
     * Unit of measurement for the dimensions (e.g., cm, in)
     *
     * @var string
     */
    public string $unit;

    /**
     * Get the length of the package
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Set the length of the package
     *
     * @param int $length
     * @return void
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * Get the width of the package
     *
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Set the width of the package
     *
     * @param int $width
     * @return void
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * Get the height of the package
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Set the height of the package
     *
     * @param int $height
     * @return void
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
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
     * @return void
     */
    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}
