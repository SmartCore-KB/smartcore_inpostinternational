<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Pickup;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Smartcore\InPostInternational\Model\PickupRepository;

class Delete extends Action
{

    /**
     * Delete constructor
     *
     * @param Context $context
     * @param PickupRepository $pickupAddrRepository
     */
    public function __construct(
        Context                          $context,
        private readonly PickupRepository $pickupAddrRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Delete Pickup
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $modelId = (int)$this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($modelId) {
            $model = $this->pickupAddrRepository->load($modelId);
            try {
                $this->pickupAddrRepository->delete($model);
                $this->messageManager->addSuccessMessage(__('Pickup has been deleted.')->render());
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check if user has permissions to visit the controller
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::pickup_create');
    }
}
