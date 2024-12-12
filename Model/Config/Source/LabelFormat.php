<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class LabelFormat implements OptionSourceInterface
{

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => 'PDF_URL', 'label' => __('Url to PDF')->getText()]
        ];
    }
}
