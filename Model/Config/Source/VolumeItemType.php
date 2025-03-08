<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class VolumeItemType implements OptionSourceInterface
{

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => 'PARCEL', 'label' => __('Parcel')]
        ];
    }
}
