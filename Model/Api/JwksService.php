<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Api;

use Magento\Framework\HTTP\Client\Curl;

class JwksService
{

    /**
     * Authorization constructor.
     *
     * @param Curl $curl
     */
    public function __construct(
        private readonly Curl           $curl
    ) {
    }

    /**
     * Get JSON Web Key Set
     *
     * @param string $jwksUri
     * @return array
     */
    public function getJwks(string $jwksUri): array
    {
        $this->curl->get($jwksUri);
        $jwks = $this->curl->getBody();
        return json_decode($jwks, true);
    }
}
