<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Shipping\Model\Config;
use Smartcore\InPostInternational\Api\PickupAddressRepositoryInterface;

class OriginCountry implements OptionSourceInterface
{
    /**
     * Shipping methods mapper
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param Config $shippingConfig
     * @param PickupAddressRepositoryInterface $pickupAddrRepository
     */
    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
        protected Config $shippingConfig,
        protected PickupAddressRepositoryInterface $pickupAddrRepository
    ) {
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [[
            'value' => 'PL',
            'label' => __('Poland')->render(),
        ]];
    }
}
