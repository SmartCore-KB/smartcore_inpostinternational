<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Shipping\Model\Config;

class ShipmentTemplate implements OptionSourceInterface
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
            'label' => 'Template 1cm x 16cm x 24cm (1kg)',
        ];
        $methods[] = [
            'value' => 2,
            'label' => 'Template 1cm x 16cm x 24cm (2kg)',
        ];

        return $methods;
    }
}
