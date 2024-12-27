<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class AutoInsurance implements OptionSourceInterface
{
    public const int NO_AUTO_INSURANCE = 0;
    public const int AUTO_INSURANCE_ORDER = 1;
    public const int AUTO_INSURANCE_FIXED = 2;

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::NO_AUTO_INSURANCE, 'label' => __('No')],
            ['value' => self::AUTO_INSURANCE_ORDER, 'label' => __('Yes, order value')],
            ['value' => self::AUTO_INSURANCE_FIXED, 'label' => __('Yes, fixed value')],
        ];
    }
}
