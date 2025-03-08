<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Api;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use stdClass;

class JwtService
{
    /**
     * JwtService constructor.
     *
     * @param JWT $jwt
     * @param JWK $jwk
     */
    public function __construct(
        private readonly JWT $jwt,
        private readonly JWK $jwk
    ) {
    }

    /**
     * Decode token
     *
     * @param string $token
     * @param array $keySet
     * @return stdClass
     */
    public function decode(string $token, array $keySet): stdClass
    {
        return $this->jwt->decode($token, $keySet);
    }

    /**
     * Parse key set
     *
     * @param array $jwks
     * @return array
     */
    public function parseKeySet(array $jwks): array
    {
        return $this->jwk->parseKeySet($jwks);
    }
}
