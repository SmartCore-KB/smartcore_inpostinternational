<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Mode implements OptionSourceInterface
{
    public const string SANDBOX = 'sandbox';
    public const string PRODUCTION = 'production';

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::SANDBOX, 'label' => __('Sandbox')->getText()],
            ['value' => self::PRODUCTION, 'label' => __('Production')->getText()],
        ];
    }
}
