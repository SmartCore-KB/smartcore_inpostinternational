<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Shipping\Model\Config;
use Magento\Store\Model\ScopeInterface;

class ShippingMethods implements OptionSourceInterface
{
    private const array INPOST_CARRIER_CODES = ['inpostinternationalcourier'];

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
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function toOptionArray(bool $isActiveOnlyFlag = false, bool $onlyMethodTitle = false): array
    {
        $methods = [];
        $carriers = $this->shippingConfig->getAllCarriers();
        foreach ($carriers as $carrierCode => $carrierModel) {
            if ((!$carrierModel->isActive() && $isActiveOnlyFlag === true)
                || !in_array($carrierCode, self::INPOST_CARRIER_CODES)
            ) {
                continue;
            }

            $carrierMethods = $carrierModel->getAllowedMethods();

            if (!$carrierMethods) {
                continue;
            }
            $carrierTitle = $this->scopeConfig->getValue(
                'carriers/' . $carrierCode . '/title',
                ScopeInterface::SCOPE_STORE
            );
            foreach ($carrierMethods as $methodCode => $methodTitle) {
                /** Check it $carrierMethods array was well formed */
                if (!$methodCode) {
                    continue;
                }

                $label = ($onlyMethodTitle) ? $methodTitle : '[' . $carrierTitle . '] ' . $methodTitle;
                $methods[] = [
                    'value' => $carrierCode . '_' . $methodCode,
                    'label' => $label,
                ];
            }
        }

        return $methods;
    }
}
