<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Store\Model\ScopeInterface;

class Logo
{
    private const XML_PATH_LOGO = 'carriers/inpostinternationalcourier/logo';
    private const DEFAULT_LOGO = 'Smartcore_InPostInternational::images/inpostinternational_courier_logo.png';

    /**
     * Logo constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param Repository $assetRepository
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly Repository $assetRepository,
        private readonly UrlInterface $urlBuilder
    ) {
    }

    /**
     * Get InPost logo URL
     *
     * @param int|null $storeId
     * @return string
     */
    public function getLogoUrl(?int $storeId = null): string
    {
        $logoPath = $this->scopeConfig->getValue(
            self::XML_PATH_LOGO,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        if ($logoPath) {
            return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA])
                . 'inpostinternational/logo/' . $logoPath;
        }

        return $this->assetRepository->getUrl(self::DEFAULT_LOGO);
    }
}
