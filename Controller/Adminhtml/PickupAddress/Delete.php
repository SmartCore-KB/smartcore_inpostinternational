<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\PickupAddress;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Smartcore\InPostInternational\Model\PickupAddressRepository;

class Delete extends Action
{

    /**
     * Delete constructor
     *
     * @param Context $context
     * @param PickupAddressRepository $pickupAddrRepository
     */
    public function __construct(
        Context                          $context,
        private readonly PickupAddressRepository $pickupAddrRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Delete Pickup Address
     *
     * @return Redirect
     */
    public function execute()
    {
        $modelId = (int)$this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($modelId) {
            $model = $this->pickupAddrRepository->load($modelId);
            try {
                $this->pickupAddrRepository->delete($model);
                $this->messageManager->addSuccessMessage(__('Pickup address has been deleted.')->render());
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
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::pickupaddress_create');
    }
}
