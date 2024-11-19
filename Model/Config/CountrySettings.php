<?php
namespace Smartcore\InPostInternational\Model\Config;

use Magento\Framework\Locale\TranslatedLists;

class CountrySettings
{
    /**
     * @var array|array[]
     */
    private array $countrySettings = [
        'IT' => [
            'languageCode' => 'it_IT',
            'phonePrefix' => '+39',
            'currency' => 'EUR',
        ],
        'FR' => [
            'languageCode' => 'fr_FR',
            'phonePrefix' => '+33',
            'currency' => 'EUR',
        ],
        'LU' => [
            'languageCode' => 'fr_LU',
            'phonePrefix' => '+352',
            'currency' => 'EUR',
        ],
        'BE' => [
            'languageCode' => 'nl_BE',
            'phonePrefix' => '+32',
            'currency' => 'EUR',
        ],
        'NL' => [
            'languageCode' => 'nl_NL',
            'phonePrefix' => '+31',
            'currency' => 'EUR',
        ],
        'ES' => [
            'languageCode' => 'es_ES',
            'phonePrefix' => '+34',
            'currency' => 'EUR',
        ],
        'PT' => [
            'languageCode' => 'pt_PT',
            'phonePrefix' => '+351',
            'currency' => 'EUR',
        ],
    ];

    /**
     * CountrySettings constructor.
     *
     * @param TranslatedLists $translatedLists
     */
    public function __construct(
        private TranslatedLists $translatedLists
    ) {
    }

    /**
     * Get all country settings
     *
     * @return array|array[]|null
     */
    public function getAllCountrySettings(): ?array
    {
        return $this->countrySettings ?? null;
    }

    /**
     * Get language code by country code
     *
     * @param string $countryCode
     * @return mixed|string|null
     */
    public function getLanguageCode(string $countryCode)
    {
        return $this->countrySettings[$countryCode]['languageCode'] ?? null;
    }

    /**
     * Get phone prefix by country code
     *
     * @param string $countryCode
     * @return mixed|string|null
     */
    public function getPhonePrefix(string $countryCode)
    {
        return $this->countrySettings[$countryCode]['phonePrefix'] ?? null;
    }

    /**
     * Get phone number without prefix for country
     *
     * @param string $phoneNumber
     * @param string $countryCode
     * @return array|string|null
     */
    public function getPhoneNumberWithoutPrefixForCountry(string $phoneNumber, string $countryCode): array|string|null
    {
        $prefix = $this->countrySettings[$countryCode]['phonePrefix'] ?? null;
        $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);
        if ($prefix && str_starts_with($phoneNumber, $prefix)) {
            return substr($phoneNumber, strlen($prefix));
        }

        return $phoneNumber;
    }

    /**
     * Get currency by country code
     *
     * @param string $countryCode
     * @return mixed
     */
    public function getCurrency(string $countryCode): mixed
    {
        return $this->countrySettings[$countryCode]['currency'] ?? null;
    }

    /**
     * Get language name
     *
     * @param string $languageCode
     * @return string|null
     */
    public function getLanguageName(string $languageCode): ?string
    {
        $locales = $this->translatedLists->getOptionLocales();
        foreach ($locales as $locale) {
            if ($locale['value'] === $languageCode) {
                return $locale['label'];
            }
        }
        return null;
    }
}
