<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Shipping\Model\Config;

class Origin implements OptionSourceInterface
{
    /**
     * Shipping methods mapper
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param Config $shippingConfig
     */
    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
        protected Config $shippingConfig
    ) {
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $methods = [];
        $methods[] = [
            'value' => 1,
            'label' => 'Location 1 (Warsaw)',
        ];
        $methods[] = [
            'value' => 2,
            'label' => 'Location 2 (Krakow)',
        ];

        return $methods;
    }
}
