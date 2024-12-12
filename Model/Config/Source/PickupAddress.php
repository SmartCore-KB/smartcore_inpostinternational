<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Shipping\Model\Config;
use Smartcore\InPostInternational\Api\PickupAddressRepositoryInterface;
use Smartcore\InPostInternational\Model\PickupAddress as PickupAddressModel;

class PickupAddress implements OptionSourceInterface
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
        $addresses = [];
        $pickupAddresses = $this->pickupAddrRepository->getList();
        $defaultSet = false;

        /** @var PickupAddressModel $pickupAddress */
        foreach ($pickupAddresses as $pickupAddress) {
            $option = [
                'value' => $pickupAddress->getId(),
                'label' => $pickupAddress->getLabel(),
            ];

            if (!$defaultSet && $pickupAddress->isDefault()) {
                $option['selected'] = 'selected';
                $defaultSet = true;
            }

            $addresses[] = $option;
        }

        return $addresses;
    }
}
