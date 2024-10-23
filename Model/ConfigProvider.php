<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Backend\Model\UrlInterface;
use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\FlagManager;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class ConfigProvider
{
    //    private const string API_URL_SANDBOX = 'https://sandbox-api.inpost-group.com';
    //    private const string API_URL_PROD = 'https://api.inpost-group.com';
    private const string AUTHORIZATION_ENDPOINT = 'https://api-sandbox-pl.inpost.pl/oauth/authorize';
    private const string TOKEN_ENDPOINT = 'https://sandbox-api.inpost-group.com/auth/token';
    public const string SHIPPING_CONFIG_PATH = 'shipping/inpostinternational/';
    /**
     * @var string
     */
    private string $scopeCode;

    /**
     * ConfigProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param UrlInterface $adminUrl
     * @param EncryptorInterface $encryptor
     * @param Config $_resourceConfig
     * @param StoreManagerInterface $storeManager
     * @param FlagManager $flagManager
     * @throws NoSuchEntityException
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly UrlInterface         $adminUrl,
        private readonly EncryptorInterface   $encryptor,
        private readonly Config               $_resourceConfig,
        private readonly StoreManagerInterface $storeManager,
        private readonly FlagManager $flagManager
    ) {
        $this->scopeCode = $this->storeManager->getStore()->getCode();
    }

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode(): string
    {
        return $this->scopeConfig->getValue(
            self::SHIPPING_CONFIG_PATH . 'mode',
            ScopeInterface::SCOPE_STORE,
            $this->scopeCode
        );
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getClientId(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::SHIPPING_CONFIG_PATH . 'client_id_' . $this->getMode(),
            ScopeInterface::SCOPE_STORE,
            $this->scopeCode
        );
    }

    /**
     * Get client secret
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->encryptor->decrypt(
            $this->scopeConfig->getValue(
                self::SHIPPING_CONFIG_PATH . 'client_secret_' . $this->getMode(),
                ScopeInterface::SCOPE_STORE,
                $this->scopeCode
            )
        );
    }

    /**
     * Get client secret
     *
     * @return string
     */
    public function getWellKnownUrl(): string
    {
        return (string) $this->scopeConfig->getValue(self::SHIPPING_CONFIG_PATH . 'well_known_' . $this->getMode());
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

    /**
     * Get code verifier
     *
     * @return string
     */
    public function getCodeVerifier(): string
    {
        return $this->flagManager->getFlagData('code_verifier');
    }

    /**
     * Get callback redirect uri
     *
     * @return string
     */
    public function getCallbackRedirectUri(): string
    {
        return $this->adminUrl->getUrl('inpostinternational/oauth/callback', ['_nosecret' => true]);
    }

    /**
     * Save code verifier
     *
     * @param string $codeVerifier
     * @return void
     */
    public function saveCodeVerifier(string $codeVerifier): void
    {
        // Flag manager is used because code verifier is needed in the callback action
        // while it is hard to read it from config in this case
        $this->flagManager->saveFlag('code_verifier', $codeVerifier);
    }

    /**
     * Save access token
     *
     * @param mixed $accessToken
     * @return void
     */
    public function saveAccessToken(mixed $accessToken): void
    {
        $this->saveShippingConfig('access_token', $accessToken);
    }

    /**
     * Save access token expires at
     *
     * @param int $exp
     * @return void
     */
    public function saveAccessTokenExpiresAt(int $exp): void
    {
        $this->saveShippingConfig('access_token_expires_at', $exp);
    }

    /**
     * Save refresh token
     *
     * @param mixed $refreshToken
     * @return void
     */
    public function saveRefreshToken(mixed $refreshToken): void
    {
        $this->saveShippingConfig('refresh_token', $refreshToken);
    }

    /**
     * Save shipping config
     *
     * @param string $path
     * @param mixed $value
     * @return void
     */
    private function saveShippingConfig(string $path, mixed $value): void
    {
        $this->_resourceConfig->saveConfig(
            self::SHIPPING_CONFIG_PATH . $path,
            $value,
            ScopeInterface::SCOPE_STORE
        );
    }
}
