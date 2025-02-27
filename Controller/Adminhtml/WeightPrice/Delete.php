<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\WeightPrice;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Smartcore\InPostInternational\Model\WeightPriceRepository;

class Delete extends Action
{

    /**
     * Delete constructor
     *
     * @param Context $context
     * @param WeightPriceRepository $weightPriceRepo
     */
    public function __construct(
        Context                          $context,
        private readonly WeightPriceRepository $weightPriceRepo
    ) {
        parent::__construct($context);
    }

    /**
     * Delete weight-based price
     *
     * @return Redirect
     */
    public function execute()
    {
        $modelId = (int)$this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($modelId) {
            $model = $this->weightPriceRepo->load($modelId);
            try {
                $this->weightPriceRepo->delete($model);
                $this->messageManager->addSuccessMessage(__('Weight-based price has been deleted.')->render());
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
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::weightprice_create');
    }
}
