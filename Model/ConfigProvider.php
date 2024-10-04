<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider
{
    //    private const string API_URL_SANDBOX = 'https://sandbox-api.inpost-group.com';
    //    private const string API_URL_PROD = 'https://api.inpost-group.com';
    private const string AUTHORIZATION_ENDPOINT = 'https://api-sandbox-pl.inpost.pl/oauth/authorize';
    private const string TOKEN_ENDPOINT = 'https://api-sandbox-pl.inpost.pl/oauth/token';
    public const string SHIPPING_CONFIG_PATH = 'shipping/inpostinternational/';

    /**
     * ConfigProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(private ScopeConfigInterface $scopeConfig)
    {
    }

    /**
     * Get client id
     *
     * @return mixed
     */
    public function getClientId()
    {
        return $this->scopeConfig->getValue(self::SHIPPING_CONFIG_PATH . 'client_id', ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get client secret
     *
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->scopeConfig->getValue(self::SHIPPING_CONFIG_PATH . 'client_secret', ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get authorization endpoint
     *
     * @return string
     */
    public function getAuthorizationEndpoint(): string
    {
        return self::AUTHORIZATION_ENDPOINT;
    }

    /**
     * Get token endpoint
     *
     * @return string
     */
    public function getTokenEndpoint(): string
    {
        return self::TOKEN_ENDPOINT;
    }
}
