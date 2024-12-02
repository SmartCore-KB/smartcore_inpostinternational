<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class LabelSize implements OptionSourceInterface
{
    private const NORMAL = 'normal'; //A4
    private const A6 = 'a6';
    /**
     * @var mixed|string|null
     */
    protected mixed $code = '';

    /**
     * @param string|null $code
     */
    public function __construct(string $code = null)
    {
        $this->code = $code;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::NORMAL, 'label' => __('A4')],
            ['value' => self::A6, 'label' => __('A6')]
        ];
    }
}
