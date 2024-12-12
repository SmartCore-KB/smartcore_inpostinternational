<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\PickupAddressInterface;
use Smartcore\InPostInternational\Model\ResourceModel\PickupAddress as ResourceModel;

class PickupAddress extends AbstractModel implements PickupAddressInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'inpostinternational_pickup_address_model';

    /**
     * Initialize PickupAddress
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->getData(self::LABEL);
    }

    /**
     * Set street name
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
        return (bool)$this->getData(self::IS_DEFAULT);
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
     * Get street name
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->getData(self::STREET);
    }

    /**
     * Set street name
     *
     * @param string $street
     * @return $this
     */
    public function setStreet(string $street): static
    {
        return $this->setData(self::STREET, $street);
    }

    /**
     * Get house number
     *
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->getData(self::HOUSE_NUMBER);
    }

    /**
     * Set house number
     *
     * @param string $houseNumber
     * @return $this
     */
    public function setHouseNumber(string $houseNumber): static
    {
        return $this->setData(self::HOUSE_NUMBER, $houseNumber);
    }

    /**
     * Get flat number
     *
     * @return string
     */
    public function getFlatNumber(): string
    {
        return $this->getData(self::FLAT_NUMBER);
    }

    /**
     * Set flat number
     *
     * @param string $flatNumber
     * @return $this
     */
    public function setFlatNumber(string $flatNumber): static
    {
        return $this->setData(self::FLAT_NUMBER, $flatNumber);
    }

    /**
     * Get postal code
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->getData(self::POSTAL_CODE);
    }

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode(string $postalCode): static
    {
        return $this->setData(self::POSTAL_CODE, $postalCode);
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->getData(self::CITY);
    }

    /**
     * Set city
     *
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): static
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * Get country code
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->getData(self::COUNTRY_CODE);
    }

    /**
     * Set country code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): static
    {
        return $this->setData(self::COUNTRY_CODE, $countryCode);
    }
}
