<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Size implements OptionSourceInterface
{
    private const USE_PRODUCT_ATTRIBUTE = 'product_attribute';
    private const SMALL = 'small';
    private const MEDIUM = 'medium';
    private const LARGE = 'large';
    private const XLARGE = 'xlarge';

    private const SIZE_LABEL = [
        'product_attribute' => 'Use product attribute',
        'small' => 'Size A',
        'medium' => 'Size B',
        'large' => 'Size C',
        'xlarge' => 'Size D',
    ];

    /**
     * @var array
     */
    protected $c2cMethods = ['inpost_courier_c2c', 'inpost_courier_c2ccod'];

    /**
     * @var string
     */
    protected $shippingMethod;

    /**
     * @var bool
     */
    protected bool $inclProductAttr = true;

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function toOptionArray() : array
    {
        $sizes = [];
        if ($this->inclProductAttr) {
            $sizes[] = ['value' => self::USE_PRODUCT_ATTRIBUTE,
                'label' => self::SIZE_LABEL[self::USE_PRODUCT_ATTRIBUTE]];
        }
        array_push(
            $sizes,
            ['value' => self::SMALL, 'label' => self::SIZE_LABEL[self::SMALL]],
            ['value' => self::MEDIUM, 'label' => self::SIZE_LABEL[self::MEDIUM]],
            ['value' => self::LARGE, 'label' => self::SIZE_LABEL[self::LARGE]]
        );

        if (in_array($this->shippingMethod, $this->c2cMethods) || !$this->shippingMethod) {
            $sizes[] = ['value' => self::XLARGE, 'label' => self::SIZE_LABEL[self::XLARGE]];
        }

        return $sizes;
    }

    /**
     * Set the shipping method.
     *
     * @param string $shippingMethod
     * @return void
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Get the size label for a given size.
     *
     * @param string $size
     * @return string
     */
    public function getSizeLabel($size)
    {
        return isset(self::SIZE_LABEL[$size]) ? self::SIZE_LABEL[$size] : $size;
    }

    /**
     * Set whether to include the product attribute.
     *
     * @param bool $inclProductAttr
     * @return void
     */
    public function setInclProductAttr(bool $inclProductAttr): void
    {
        $this->inclProductAttr = $inclProductAttr;
    }
}
