<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Smartcore\InPostInternational\Helper\PkceHelper;
use Smartcore\InPostInternational\Model\ConfigProvider;

class Authorization
{

    /**
     * Authorization constructor.
     *
     * @param ConfigProvider $configProvider
     * @param StoreManagerInterface $storeManager
     * @param PkceHelper $pkceHelper
     */
    public function __construct(
        private readonly ConfigProvider        $configProvider,
        private readonly StoreManagerInterface $storeManager,
        private readonly PkceHelper            $pkceHelper
    ) {
    }

    /**
     * Get authorization url
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getAuthorizationUrl(): string
    {
        $clientId = $this->configProvider->getClientId();
        $codeVerifier = $this->pkceHelper->generateCodeVerifier();
        $codeChallenge = $this->pkceHelper->generateCodeChallenge($codeVerifier);

        $queryParams = [
            'client_id' => $clientId,
            'redirect_uri' => $this->storeManager->getStore()->getBaseUrl() . 'inpostinternational/oauth/callback',
            'response_type' => 'code',
            'scope' => 'api:shipments:write api:tracking:read api:one-time-pickups:write api:points:read'
                . ' offline_access',
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256'
        ];

        // @TODO move to config model
        return 'https://sandbox-login.inpost-group.com/realm/external/protocol/openid-connect/auth?'
            . http_build_query($queryParams);
    }
}
