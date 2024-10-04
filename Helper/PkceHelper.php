<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Helper;

use Magento\Config\Model\ResourceModel\Config;
use Magento\Store\Model\ScopeInterface;
use Smartcore\InPostInternational\Model\ConfigProvider;

class PkceHelper
{

    /**
     * PkceHelper constructor.
     *
     * @param Config $_resourceConfig
     * @param ConfigProvider $configProvider
     */
    public function __construct(
        protected Config       $_resourceConfig,
        private ConfigProvider $configProvider
    ) {
    }

    /**
     * Generate code verifier
     *
     * @return string
     */
    public function generateCodeVerifier(): string
    {
        $random = bin2hex(openssl_random_pseudo_bytes(32));
        $result = rtrim(strtr(base64_encode($random), '+/', '-_'), '=');
        $this->_resourceConfig->saveConfig(
            $this->configProvider::SHIPPING_CONFIG_PATH . 'code_verifier',
            $result,
            ScopeInterface::SCOPE_STORE
        );

        return $result;
    }

    /**
     * Generate code challenge
     *
     * @param string $codeVerifier
     * @return string
     */
    public function generateCodeChallenge(string $codeVerifier): string
    {
        $hash = hash('sha256', $codeVerifier, true);
        return rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');
    }
}
