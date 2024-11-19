<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Smartcore\InPostInternational\Model\ConfigProvider;

class DestinationCountry implements OptionSourceInterface
{
    /**
     * Shipping methods mapper
     *
     * @param ConfigProvider $configProvider
     * @param CountryCollectionFactory $countryCollFactory
     */
    public function __construct(
        protected ConfigProvider           $configProvider,
        protected CountryCollectionFactory $countryCollFactory,
    ) {
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $configuredCountries = explode(',', $this->configProvider->getShippingCountries());
        $options = [];

        if (is_array($configuredCountries)) {
            $countryCollection = $this->countryCollFactory->create()
                ->addFieldToFilter('country_id', ['in' => $configuredCountries])
                ->loadByStore();

            foreach ($countryCollection as $country) {
                $options[] = [
                    'value' => $country->getCountryId(),
                    'label' => $country->getName()
                ];
            }
            usort($options, fn ($first, $second) => $first['label'] <=> $second['label']);
        }

        return $options;
    }
}
