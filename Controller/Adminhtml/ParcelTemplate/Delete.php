<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\ParcelTemplate;

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
     * @param PickupAddressRepository $parcelTmplRepository
     */
    public function __construct(
        Context                          $context,
        private PickupAddressRepository $parcelTmplRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Delete Parcel Template
     *
     * @return Redirect
     */
    public function execute()
    {
        $modelId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($modelId) {
            $model = $this->parcelTmplRepository->load($modelId);
            try {
                $this->parcelTmplRepository->delete($model);
                $this->messageManager->addSuccessMessage(__('Parcel template has been deleted.')->getText());
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
