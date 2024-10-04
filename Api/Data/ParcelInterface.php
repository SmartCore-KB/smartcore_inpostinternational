<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface ParcelInterface
{
    /**
     * Get ID
     *
     * @return string
     */
    public function getId();

    /**
     * Set ID
     *
     * @param string $parcelId
     * @return $this
     */
    public function setId($parcelId);

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight();

    /**
     * Set weight
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight($weight);

    /**
     * Get length
     *
     * @return float
     */
    public function getLength();

    /**
     * Set length
     *
     * @param float $length
     * @return $this
     */
    public function setLength($length);

    /**
     * Get width
     *
     * @return float
     */
    public function getWidth();

    /**
     * Set width
     *
     * @param float $width
     * @return $this
     */
    public function setWidth($width);

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight();

    /**
     * Set height
     *
     * @param float $height
     * @return $this
     */
    public function setHeight($height);

    /**
     * Get tracking number
     *
     * @return string|null
     */
    public function getTrackingNumber();

    /**
     * Set tracking number
     *
     * @param string|null $trackingNumber
     * @return $this
     */
    public function setTrackingNumber($trackingNumber);
}
