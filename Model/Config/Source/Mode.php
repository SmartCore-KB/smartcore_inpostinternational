<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Mode implements OptionSourceInterface
{
    public const SANDBOX = 'sandbox';
    public const PRODUCTION = 'production';

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::SANDBOX, 'label' => __('Sandbox')->render()],
            ['value' => self::PRODUCTION, 'label' => __('Production')->render()],
        ];
    }
}
