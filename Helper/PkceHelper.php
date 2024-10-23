<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Helper;

use Magento\Framework\App\Cache\Manager;
use Magento\Framework\App\Cache\Type\Config;
use Smartcore\InPostInternational\Model\ConfigProvider;

class PkceHelper
{

    /**
     * PkceHelper constructor.
     *
     * @param ConfigProvider $configProvider
     * @param Manager $cacheManager
     */
    public function __construct(
        private readonly ConfigProvider $configProvider,
        private readonly Manager $cacheManager
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
        $this->configProvider->saveCodeVerifier($result);
        $this->cacheManager->clean([Config::TYPE_IDENTIFIER]);

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
