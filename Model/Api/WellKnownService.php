<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Smartcore\InPostInternational\Model\ConfigProvider;

class WellKnownService
{
    /**
     * @var array|null
     */
    private ?array $configuration = null;

    /**
     * WellKnownService constructor.
     *
     * @param Curl $curl
     * @param Json $json
     * @param ConfigProvider $configProvider
     */
    public function __construct(
        private readonly Curl           $curl,
        private readonly Json           $json,
        private readonly ConfigProvider $configProvider,
    ) {
    }

    /**
     * Get well-known configuration
     *
     * @return array|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getConfiguration(): ?array
    {
        if ($this->configuration === null) {
            $this->fetchConfiguration();
        }
        return $this->configuration;
    }

    /**
     * Fetch configuration from well-known endpoint
     *
     * @return void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function fetchConfiguration(): void
    {
        $this->curl->get($this->configProvider->getWellKnownUrl());
        $response = $this->curl->getBody();
        $this->configuration = $this->json->unserialize($response);
    }

    /**
     * Get jwks uri
     *
     * @return string|null
     */
    public function getJwksUri(): ?string
    {
        return $this->getConfiguration()['jwks_uri'] ?? null;
    }

    /**
     * Get issuer
     *
     * @return string|null
     */
    public function getIssuer(): ?string
    {
        return $this->getConfiguration()['issuer'] ?? null;
    }

    /**
     * Get authorization endpoint
     *
     * @return string|null
     */
    public function getAuthorizationEndpoint(): ?string
    {
        return $this->getConfiguration()['authorization_endpoint'] ?? null;
    }

    /**
     * Get token endpoint
     *
     * @return string|null
     */
    public function getTokenEndpoint(): ?string
    {
        return $this->getConfiguration()['token_endpoint'] ?? null;
    }
}
