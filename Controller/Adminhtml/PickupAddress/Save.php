<?php
namespace Smartcore\InPostInternational\Controller\Adminhtml\PickupAddress;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Smartcore\InPostInternational\Model\PickupAddressFactory;
use Smartcore\InPostInternational\Model\PickupAddressRepository;

class Save extends Action
{

    /**
     * Save constructor
     *
     * @param Context $context
     * @param PickupAddressFactory $pickupTmplFactory
     * @param PickupAddressRepository $pickupTmplRepository
     */
    public function __construct(
        Context                          $context,
        protected PickupAddressFactory  $pickupTmplFactory,
        private PickupAddressRepository $pickupTmplRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Save Pickup address
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue('pickupaddress_fieldset');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->pickupTmplFactory->create();

            if (isset($data['entity_id'])) {
                $model = $this->pickupTmplRepository->load($data['entity_id']);
            }

            $model->setData($data);

            try {
                $this->pickupTmplRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Pickup address has been saved.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
