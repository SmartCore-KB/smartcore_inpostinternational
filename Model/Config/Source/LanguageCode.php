<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Smartcore\InPostInternational\Model\Config\CountrySettings;
use Smartcore\InPostInternational\Model\ConfigProvider;

class LanguageCode implements OptionSourceInterface
{
    /**
     * Shipping methods mapper
     *
     * @param ConfigProvider $configProvider
     * @param CountryCollectionFactory $countryCollFactory
     * @param CountrySettings $countrySettings
     */
    public function __construct(
        protected ConfigProvider           $configProvider,
        protected CountryCollectionFactory $countryCollFactory,
        private readonly CountrySettings   $countrySettings,
    ) {
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $configuredCountries = array_keys($this->countrySettings->getAllCountrySettings());
        $options = [];

        if (is_array($configuredCountries)) {
            foreach ($configuredCountries as $configuredCountry) {
                $countrySettings = $this->countrySettings->getAllCountrySettings();
                $languageCode = $countrySettings[$configuredCountry]['languageCode'];
                $options[] = [
                    'value' => $languageCode,
                    'label' => $this->countrySettings->getLanguageName($languageCode)
                ];
            }
            usort($options, fn ($first, $second) => $first['label'] <=> $second['label']);
        }

        return $options;
    }
}
