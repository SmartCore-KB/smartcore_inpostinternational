<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\HTTP\Client\Curl;
use Smartcore\InPostInternational\Exception\InvalidTokenException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\Api\JwtService;

class TokenExchangeService
{

    /**
     * Authorization constructor.
     *
     * @param ConfigProvider $configProvider
     * @param Curl $curl
     * @param JwtService $jwtService
     * @param Config $_resourceConfig
     */
    public function __construct(
        private readonly ConfigProvider $configProvider,
        private readonly Curl           $curl,
        private readonly JwtService     $jwtService,
        protected Config                $_resourceConfig,
    ) {
    }

    /**
     * Exchange authorization code for token
     *
     * @param string $authorizationCode
     * @return mixed
     */
    public function exchangeCodeForToken(string $authorizationCode): mixed
    {
        $params = [
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode,
            'redirect_uri' => $this->configProvider->getCallbackRedirectUri(),
            'client_id' => $this->configProvider->getClientId(),
            'client_secret' => $this->configProvider->getClientSecret(),
            'code_verifier' => $this->configProvider->getCodeVerifier()
        ];

        $this->curl->post($this->configProvider->getTokenEndpoint(), $params);
        return json_decode($this->curl->getBody(), true);
    }

    /**
     * Validate and save received tokens
     *
     * @param mixed $tokenResponse
     * @return bool
     * @throws Exception
     */
    public function validateAndSaveTokens(mixed $tokenResponse): bool
    {
        try {
            $accessToken = $tokenResponse['access_token'] ?: null;
            $refreshToken = $tokenResponse['refresh_token'] ?: null;
            $decodedAccessToken = $this->jwtService->validateAccessToken($accessToken);
        } catch (Exception $e) {
            throw new InvalidTokenException(sprintf('Invalid tokens. %s', $e->getMessage()));
        }

        try {
            $this->configProvider->saveAccessToken($accessToken);
            $this->configProvider->saveAccessTokenExpiresAt($decodedAccessToken->exp);
            $this->configProvider->saveRefreshToken($refreshToken);
        } catch (Exception $e) {
            throw new TokenSaveException(sprintf('Failed to save tokens: %s', $e->getMessage()));
        }

        return true;
    }
}
