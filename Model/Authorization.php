<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Store\Model\StoreManagerInterface;
use Random\RandomException;
use Smartcore\InPostInternational\Helper\PkceHelper;

class Authorization
{

    /**
     * Authorization constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param ConfigProvider $config
     * @param PkceHelper $pkceHelper
     * @param Curl $curl
     */
    public function __construct(
        private StoreManagerInterface $storeManager,
        private ConfigProvider        $config,
        private PkceHelper            $pkceHelper,
        private Curl                  $curl
    ) {
    }

    /**
     * Get authorization url
     *
     * @return string
     * @throws NoSuchEntityException
     * @throws RandomException
     */
    public function getAuthorizationUrl(): string
    {
        $codeVerifier = $this->pkceHelper->generateCodeVerifier();
        $codeChallenge = $this->pkceHelper->generateCodeChallenge($codeVerifier);

        $params = [
            'response_type' => 'code',
            'client_id' => $this->config->getClientId(),
            // @TODO change to proper redirect uri
            'redirect_uri' => $this->storeManager->getStore()->getBaseUrl() . 'oauth/callback',
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
            'state' => bin2hex(random_bytes(16))
        ];

        return $this->config->getAuthorizationEndpoint() . '?' . http_build_query($params);
    }

    /**
     * Exchange authorization code for token
     *
     * @param string $authorizationCode
     * @param string $codeVerifier
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function exchangeCodeForToken(string $authorizationCode, string $codeVerifier): mixed
    {
        $params = [
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode,
            // @TODO change to proper redirect uri
            'redirect_uri' => $this->storeManager->getStore()->getBaseUrl() . 'oauth/callback',
            'client_id' => $this->config->getClientId(),
            'client_secret' => $this->config->getClientSecret(),
            'code_verifier' => $codeVerifier
        ];

        $this->curl->post($this->config->getTokenEndpoint(), $params);
        $response = json_decode($this->curl->getBody(), true);

        return $response;
    }
}
