<?php

namespace Smartcore\InPostInternational\Model\Data;

class Destination
{
    /**
     * ISO country code of the destination
     *
     * @var string
     */
    public string $countryCode;

    /**
     * Name of the destination point
     *
     * @var string
     */
    public string $pointName;

    /**
     * Get the ISO country code of the destination
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * Set the ISO country code of the destination
     *
     * @param string $countryCode
     * @return void
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Get the name of the destination point
     *
     * @return string
     */
    public function getPointName(): string
    {
        return $this->pointName;
    }

    /**
     * Set the name of the destination point
     *
     * @param string $pointName
     * @return void
     */
    public function setPointName(string $pointName): void
    {
        $this->pointName = $pointName;
    }
}
