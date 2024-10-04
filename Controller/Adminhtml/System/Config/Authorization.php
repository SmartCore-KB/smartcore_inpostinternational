<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\System\Config;

use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Smartcore\InPostInternational\Model\Config\Authorization as AuthorizationModel;

class Authorization
{

    /**
     * Authorization constructor.
     *
     * @param RedirectFactory $redirectFactory
     * @param AuthorizationModel $authorizationModel
     */
    public function __construct(
        private RedirectFactory      $redirectFactory,
        protected AuthorizationModel $authorizationModel
    ) {
    }

    /**
     * Authorization action
     *
     * @throws NoSuchEntityException
     */
    public function execute(): Redirect
    {
        $generatedUrl = $this->authorizationModel->getAuthorizationUrl();
        $resultRedirect = $this->redirectFactory->create();
        $resultRedirect->setUrl($generatedUrl);
        return $resultRedirect;
    }
}
