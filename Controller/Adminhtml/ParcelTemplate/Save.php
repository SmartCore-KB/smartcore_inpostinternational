<?php
namespace Smartcore\InPostInternational\Controller\Adminhtml\ParcelTemplate;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Smartcore\InPostInternational\Model\ParcelTemplateFactory;
use Smartcore\InPostInternational\Model\PickupAddressRepository;

class Save extends Action
{

    /**
     * Save constructor
     *
     * @param Context $context
     * @param ParcelTemplateFactory $parcelTmplFactory
     * @param PickupAddressRepository $parcelTmplRepository
     */
    public function __construct(
        Context                          $context,
        protected ParcelTemplateFactory  $parcelTmplFactory,
        private PickupAddressRepository $parcelTmplRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Save Parcel Template
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue('parceltemplate_fieldset');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->parcelTmplFactory->create();

            if (isset($data['entity_id'])) {
                $model = $this->parcelTmplRepository->load($data['entity_id']);
            }

            $model->setData($data);

            try {
                $this->parcelTmplRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Parcel template has been saved.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
