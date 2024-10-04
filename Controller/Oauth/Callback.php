<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Oauth;

use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Smartcore\InPostInternational\Model\Authorization;
use Smartcore\InPostInternational\Model\ConfigProvider;

class Callback
{
    /**
     * Callback constructor.
     *
     * @param Context $context
     * @param Authorization $authorization
     * @param Config $_resourceConfig
     * @param ConfigProvider $configProvider
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        protected Context      $context,
        private Authorization  $authorization,
        protected Config       $_resourceConfig,
        private ConfigProvider $configProvider,
        private RedirectFactory      $redirectFactory
    ) {
    }

    /**
     * Callback action
     *
     * @return Redirect
     * @throws NoSuchEntityException
     */
    public function execute(): Redirect
    {
        $code = $this->getRequest()->getParam('code');
        //        $state = $this->getRequest()->getParam('state');
        // Check $state for security
        // get code verifier from core_config_data
        $codeVerifier = '...';
        $tokenResponse = $this->authorization->exchangeCodeForToken($code, $codeVerifier);

        $this->_resourceConfig->saveConfig(
            $this->configProvider::SHIPPING_CONFIG_PATH . 'token_response',
            $tokenResponse,
            ScopeInterface::SCOPE_STORE
        );
        // save response
        $resultRedirect = $this->redirectFactory->create();
        $resultRedirect->setPath('adminhtml/system_config/edit/section/inpostinternational');
        return $resultRedirect;
    }
}
