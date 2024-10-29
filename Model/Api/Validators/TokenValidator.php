<?php

namespace Smartcore\InPostInternational\Model\Api\Validators;

use Exception;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Smartcore\InPostInternational\Exception\AccessTokenValidationException;
use Smartcore\InPostInternational\Exception\InvalidAuthorizedPartyException;
use Smartcore\InPostInternational\Exception\InvalidIssuerException;
use Smartcore\InPostInternational\Exception\MissingRequiredClaimsException;
use Smartcore\InPostInternational\Model\Api\JwksService;
use Smartcore\InPostInternational\Model\Api\WellKnownService;
use stdClass;

class TokenValidator
{

    /**
     * TokenValidator constructor.
     *
     * @param ClaimsValidator $claimsValidator
     * @param JWT $jwt
     * @param JWK $jwk
     * @param WellKnownService $wellKnownService
     * @param JwksService $jwksService
     */
    public function __construct(
        private readonly ClaimsValidator $claimsValidator,
        private readonly JWT $jwt,
        private readonly JWK $jwk,
        private readonly WellKnownService $wellKnownService,
        private readonly JwksService $jwksService,
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
            $decodedJWT = $this->validateJwt($token);

            if ($decodedJWT->typ !== 'Bearer') {
                throw new AccessTokenValidationException('Invalid token type');
            }

            return $decodedJWT;
        } catch (Exception $e) {
            throw new AccessTokenValidationException('Access token validation failed: ' . $e->getMessage());
        }
    }

    /**
     * Validate JWT
     *
     * @param string $token
     * @return stdClass
     * @throws InvalidAuthorizedPartyException
     * @throws InvalidIssuerException
     * @throws MissingRequiredClaimsException
     */
    private function validateJwt(string $token): stdClass
    {
        $jwks = $this->getJwks();
        $keySet = $this->jwk->parseKeySet($jwks);
        $decodedJWT = $this->jwt->decode($token, $keySet);
        $this->claimsValidator->validateCommonClaims($decodedJWT);

        return $decodedJWT;
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
}
