<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Smartcore\InPostInternational\Model\Config\CountrySettings;
use Smartcore\InPostInternational\Model\ConfigProvider;

class CountryShipFrom extends CountryShip implements OptionSourceInterface
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
        parent::__construct($countryCollFactory);
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $allCountries = $this->countrySettings->getCountryCanShipFromSettings();

        return $this->getOptionsFromCountrySettings($allCountries);
    }
}
