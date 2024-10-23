<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Smartcore\InPostInternational\Model\Config\RequestAuthorization as AuthorizationModel;

class RequestAuthorization extends Action
{
    /**
     * Request authorization constructor.
     *
     * @param Context $context
     * @param RedirectFactory $redirectFactory
     * @param AuthorizationModel $authorizationModel
     */
    public function __construct(
        Context                          $context,
        private readonly RedirectFactory $redirectFactory,
        protected AuthorizationModel     $authorizationModel
    ) {
        parent::__construct($context);
    }

    /**
     * Request authorization action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $generatedUrl = $this->authorizationModel->getRequestAuthorizationUrl();
        $resultRedirect = $this->redirectFactory->create();
        $resultRedirect->setUrl($generatedUrl);
        return $resultRedirect;
    }
}
