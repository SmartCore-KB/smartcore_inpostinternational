<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Priority implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => 'STANDARD', 'label' => __('Standard')->render()]
        ];
    }
}
