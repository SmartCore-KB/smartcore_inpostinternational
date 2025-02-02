<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Smartcore\InPostInternational\Api\Data\PickupAddressInterface;
use Smartcore\InPostInternational\Model\ResourceModel\PickupAddress as ResourceModel;

class PickupAddress extends PickupCommon implements PickupAddressInterface
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
     * Copy data to Pickup model
     *
     * @param Pickup $pickup
     * @return void
     */
    public function copyToPickup(Pickup &$pickup): void
    {
        $fields = [
            'AddressStreet', 'AddressHouseNumber', 'AddressFlatNumber', 'AddressPostalCode', 'AddressCity',
            'AddressCountryCode', 'ContactFirstName', 'ContactLastName', 'ContactEmail', 'ContactPhonePrefix',
            'ContactPhoneNumber', 'LocationDescription'
        ];

        foreach ($fields as $field) {
            $pickup->{"set$field"}($this->{"get$field"}());
        }
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
}
