<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class DestinationDto extends AbstractDto
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
     * @return $this
     */
    public function setCountryCode(string $countryCode): static
    {
        $this->countryCode = $countryCode;
        return $this;
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
     * @return $this
     */
    public function setPointName(string $pointName): static
    {
        $this->pointName = $pointName;
        return $this;
    }
}
