<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ShipmentType implements OptionSourceInterface
{
    public const string ADDRESS_TO_POINT = 'address-to-point';
    public const string POINT_TO_POINT = 'point-to-point';

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::ADDRESS_TO_POINT,
                'label' => __('From address (courier pickup)')->getText()],
            ['value' => self::POINT_TO_POINT,
                'label' => __('From point (Locker, Pick-up Drop-off Point, other)')->getText()]
        ];
    }
}
