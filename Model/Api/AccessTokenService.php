<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Api;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\Client\Curl;
use Smartcore\InPostInternational\Exception\AccessTokenValidationException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\Api\Validators\TokenValidator;
use Smartcore\InPostInternational\Model\ConfigProvider;
use stdClass;

class AccessTokenService
{

    public const int ACCESS_TOKEN_EXPIRING_AT_THRESHOLD = 30;

    /**
     * AccessTokenService constructor.
     *
     * @param ConfigProvider $configProvider
     * @param WellKnownService $wellKnownService
     * @param JwksService $jwksService
     * @param JwtService $jwtService
     * @param Curl $curl
     * @param TokenValidator $tokenValidator
     */
    public function __construct(
        private readonly ConfigProvider   $configProvider,
        private readonly WellKnownService $wellKnownService,
        private readonly JwksService      $jwksService,
        private readonly JwtService       $jwtService,
        private readonly Curl             $curl,
        private readonly TokenValidator   $tokenValidator,
    ) {
    }

    /**
     * Get access token - main method
     *
     * @return string
     * @throws TokenSaveException
     */
    public function getAccessToken(): string
    {
        $accessToken = $this->configProvider->getRawAccessToken();
        $accessTokenExpiresAt = $this->configProvider->getAccessTokenExpiresAt();
        if (time() + self::ACCESS_TOKEN_EXPIRING_AT_THRESHOLD > $accessTokenExpiresAt) {
            try {
                $accessToken = $this->refreshAccessToken();
                $this->saveAccessToken($accessToken);
            } catch (Exception $e) {
                throw new TokenSaveException(sprintf(
                    'Failed to save access token after refresh: %s',
                    $e->getMessage()
                ));
            }

        }

        return $accessToken;
    }

    /**
     * Save access token
     *
     * @param string $accessToken
     * @throws AccessTokenValidationException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function saveAccessToken(string $accessToken): void
    {
        $decodedAccessToken = $this->getDecodedAccessToken($accessToken);
        $this->tokenValidator->validateAccessToken($decodedAccessToken);
        $this->configProvider->saveAccessTokenExpiresAt($decodedAccessToken->exp);
        $this->configProvider->saveAccessToken($accessToken);
    }

    /**
     * Decode and validate access token
     *
     * @param string $token
     * @return stdClass
     */
    public function getDecodedAccessToken(string $token): stdClass
    {
        $jwks = $this->getJwks();
        $keySet = $this->jwtService->parseKeySet($jwks);
        return $this->jwtService->decode($token, $keySet);
    }

    /**
     * Get JSON Web Key Set
     *
     * @return array
     */
    private function getJwks(): array
    {
        $jwksUri = $this->wellKnownService->getJwksUri();

        return $this->jwksService->getJwks($jwksUri);
    }

    /**
     * Request for access token refresh
     *
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function refreshAccessToken(): string
    {
        $params = [
            'client_id' => $this->configProvider->getClientId(),
            'client_secret' => $this->configProvider->getClientSecret(),
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->configProvider->getRawRefreshToken()
        ];
        $this->curl->post($this->wellKnownService->getTokenEndpoint(), $params);
        $result = json_decode($this->curl->getBody());
        return $result?->access_token;
    }
}
