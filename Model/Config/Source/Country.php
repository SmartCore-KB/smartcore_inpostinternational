<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Smartcore\InPostInternational\Model\Config\CountrySettings;
use Smartcore\InPostInternational\Model\ConfigProvider;

class Country implements OptionSourceInterface
{
    /**
     * Countries
     *
     * @param ConfigProvider $configProvider
     * @param CountryCollectionFactory $countryCollFactory
     * @param CountrySettings $countrySettings
     */
    public function __construct(
        protected ConfigProvider           $configProvider,
        protected CountryCollectionFactory $countryCollFactory,
        protected CountrySettings          $countrySettings
    ) {
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $allCountries = $this->countrySettings->getAllCountrySettings();

        $countryCollection = $this->countryCollFactory->create()
            ->addFieldToFilter('country_id', ['in' => array_keys($allCountries)])
            ->loadByStore();

        $options = [];
        foreach (array_keys($allCountries) as $countryKey) {
            $options[] = [
                'value' => $countryKey,
                'label' => $countryCollection->getItemByColumnValue('country_id', $countryKey)->getName()
            ];
        }
        usort($options, fn ($first, $second) => $first['label'] <=> $second['label']);

        return $options;
    }
}
