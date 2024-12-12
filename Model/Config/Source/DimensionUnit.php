<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DimensionUnit implements OptionSourceInterface
{

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [[
            'value' => 'CM', 'label' => __('Centimeters')->getText(),
        ]];
    }
}
