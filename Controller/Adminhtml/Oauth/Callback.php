<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Oauth;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Smartcore\InPostInternational\Exception\AuthorizationCodeNotFoundException;
use Smartcore\InPostInternational\Model\TokenExchangeService;

class Callback extends Action
{

    /**
     * @inheritdoc
     * @var array
     */
    protected $_publicActions = ['callback'];

    /**
     * Callback constructor.
     *
     * @param Context $context
     * @param TokenExchangeService $tokenExchangeService
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        protected Context                     $context,
        private readonly TokenExchangeService $tokenExchangeService,
        private readonly RedirectFactory      $redirectFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Callback action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->redirectFactory->create();
        $resultRedirect->setPath('adminhtml/system_config/edit/section/shipping');
        $code = $this->getRequest()->getParam('code');
        try {
            $this->handleTokenExchange($code);
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__(
                'Failed to authorize because of exception: %1',
                $e->getMessage()
            )->render());
        }

        return $resultRedirect;
    }

    /**
     * Handle token exchange logic
     *
     * @param string|null $code
     * @throws Exception
     */
    private function handleTokenExchange(?string $code): void
    {
        if (!$code) {
            throw new AuthorizationCodeNotFoundException('Authorization code not found');
        }
        $tokenResponse = $this->tokenExchangeService->exchangeCodeForToken($code);

        if (isset($tokenResponse['error'])) {
            $this->messageManager->addErrorMessage(
                __('Failed to authorize because of error: %1', $tokenResponse['error_description'] ?? '')->render()
            );
        }

        if ($this->tokenExchangeService->validateAndSaveTokens($tokenResponse)) {
            $this->messageManager->addSuccessMessage(__('Authorization successful')->render());
            return;
        }
        $this->messageManager->addErrorMessage(__('Failed to save tokens')->render());
    }
}
