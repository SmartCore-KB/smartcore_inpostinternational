<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class LabelFormat implements OptionSourceInterface
{
    private const PDF = 'pdf';
    private const EPL = 'epl';
    private const ZPL = 'zpl';

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::PDF, 'label' => __('PDF')],
            ['value' => self::EPL, 'label' => __('EPL')],
            ['value' => self::ZPL, 'label' => __('ZPL')],
        ];
    }
}
