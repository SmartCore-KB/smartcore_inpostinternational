<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Currency implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => 'EUR', 'label' => __('EUR')->getText()]
        ];
    }
}
