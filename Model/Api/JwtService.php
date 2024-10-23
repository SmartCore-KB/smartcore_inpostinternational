<?php

namespace Smartcore\InPostInternational\Model\Api;

use Smartcore\InPostInternational\Exception\AccessTokenValidationException;
use Smartcore\InPostInternational\Exception\RefreshTokenValidationException;
use Smartcore\InPostInternational\Model\Api\Validators\TokenValidator;
use stdClass;

class JwtService
{
    /**
     * JwtService constructor.
     *
     * @param TokenValidator $tokenValidator
     */
    public function __construct(
        private readonly TokenValidator $tokenValidator
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
        return $this->tokenValidator->validateAccessToken($token);
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
        return $this->tokenValidator->validateRefreshToken($token);
    }
}
