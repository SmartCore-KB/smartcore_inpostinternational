<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Phone
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
     * @return void
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
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
     * @return void
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
}
