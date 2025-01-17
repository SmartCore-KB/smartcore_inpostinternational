<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PriceCalculationType implements OptionSourceInterface
{
    public const FIXED = 'fixed';
    public const WEIGHT = 'weight';

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::FIXED, 'label' => __('Fixed')],
            ['value' => self::WEIGHT, 'label' => __('Based on Cart Weight')],
        ];
    }
}
