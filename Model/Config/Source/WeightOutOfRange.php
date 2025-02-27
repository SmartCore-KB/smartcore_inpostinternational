<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class WeightOutOfRange implements OptionSourceInterface
{
    public const USE_PRICE = 'use_price';
    public const BLOCK_SHIP = 'block_ship';

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::USE_PRICE, 'label' => __('Use price from "Price" field below')],
            ['value' => self::BLOCK_SHIP, 'label' => __('Do not allow to ship')],
        ];
    }
}
