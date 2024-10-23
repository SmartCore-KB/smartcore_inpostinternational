<?php

namespace Smartcore\InPostInternational\Model\Api\Validators;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use InvalidArgumentException;
use Smartcore\InPostInternational\Exception\AccessTokenValidationException;
use Smartcore\InPostInternational\Exception\RefreshTokenValidationException;
use stdClass;

class TokenValidator
{

    /**
     * TokenValidator constructor.
     *
     * @param ClaimsValidator $claimsValidator
     * @param JWT $jwt
     */
    public function __construct(
        private readonly ClaimsValidator $claimsValidator,
        private readonly JWT $jwt
    ) {
    }

    /**
     * Validate access token
     *
     * @param string $token
     * @return stdClass
     * @throws AccessTokenValidationException
     */
    public function validateAccessToken(string $token): stdClass
    {
        try {
            $header = $this->decodeHeader($token);
            $decoded = $this->jwt->decode($token, new Key($header['kid'], 'RS256'));

            $this->claimsValidator->validateCommonClaims($decoded);

            if ($decoded->typ !== 'Bearer') {
                throw new AccessTokenValidationException('Invalid token type');
            }

            return $decoded;
        } catch (Exception $e) {
            throw new AccessTokenValidationException('Access token validation failed: ' . $e->getMessage());
        }
    }

    /**
     * Validate refresh token
     *
     * @param string $token
     * @return stdClass
     * @throws RefreshTokenValidationException
     */
    public function validateRefreshToken(string $token): stdClass
    {
        try {
            $header = $this->decodeHeader($token);
            $decoded = $this->jwt->decode($token, new Key($header['kid'], 'HS512'));

            $this->claimsValidator->validateCommonClaims($decoded);

            if ($decoded->typ !== 'Offline') {
                throw new RefreshTokenValidationException('Invalid token type');
            }

            if ($decoded->aud !== ClaimsValidator::ISS) {
                throw new RefreshTokenValidationException('Invalid audience');
            }

            return $decoded;
        } catch (Exception $e) {
            throw new RefreshTokenValidationException('Refresh token validation failed: ' . $e->getMessage());
        }
    }

    /**
     * Decode JWT header
     *
     * @param string $token
     * @return array
     */
    private function decodeHeader(string $token): array
    {
        $segments = explode('.', $token);
        if (count($segments) !== 3) {
            throw new InvalidArgumentException('Invalid token format');
        }

        $header = $segments[0];
        $decodedHeader = $this->jwt->jsonDecode($this->jwt->urlsafeB64Decode($header));

        return (array) $decodedHeader;
    }
}
