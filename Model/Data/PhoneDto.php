<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class PhoneDto extends AbstractDto
{
    /**
     * Country or area code prefix of the phone number
     *
     * @var string
     */
    public string $prefix;

    /**
     * Local part of the phone number
     *
     * @var string
     */
    public string $number;

    /**
     * Get the country or area code prefix of the phone number
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Set the country or area code prefix of the phone number
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Get the local part of the phone number
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set the local part of the phone number
     *
     * @param string $number
     * @return $this
     */
    public function setNumber(string $number): static
    {
        $this->number = $number;
        return $this;
    }
}
