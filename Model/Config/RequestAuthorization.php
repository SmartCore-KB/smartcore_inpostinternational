<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config;

use Smartcore\InPostInternational\Helper\PkceHelper;
use Smartcore\InPostInternational\Model\Api\WellKnownService;
use Smartcore\InPostInternational\Model\ConfigProvider;

class RequestAuthorization
{

    /**
     * Authorization constructor.
     *
     * @param ConfigProvider $configProvider
     * @param PkceHelper $pkceHelper
     * @param WellKnownService $wellKnownService
     */
    public function __construct(
        private ConfigProvider $configProvider,
        private PkceHelper     $pkceHelper,
        private WellKnownService     $wellKnownService
    ) {
    }

    /**
     * Get authorization url
     *
     * @return string
     */
    public function getRequestAuthorizationUrl(): string
    {
        $clientId = $this->configProvider->getClientId();
        $codeVerifier = $this->pkceHelper->generateCodeVerifier();
        $codeChallenge = $this->pkceHelper->generateCodeChallenge($codeVerifier);

        $queryParams = [
            'client_id' => $clientId,
            'redirect_uri' => $this->configProvider->getCallbackRedirectUri(),
            'response_type' => 'code',
            'scope' => 'api:shipments:write api:tracking:read api:one-time-pickups:write api:points:read'
                . ' offline_access',
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256'
        ];

        return $this->wellKnownService->getAuthorizationEndpoint() . '?' . http_build_query($queryParams);
    }
}
