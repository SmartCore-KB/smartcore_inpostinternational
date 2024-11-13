<?php

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipments;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Smartcore\InPostInternational\Model\ShipmentFactory;

class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var ShipmentFactory
     */
    protected $shipmentFactory;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param ShipmentFactory $shipmentFactory
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        ShipmentFactory $shipmentFactory,
        private readonly RedirectFactory      $redirectFactory
    ) {
        $this->dataPersistor   = $dataPersistor;
        $this->shipmentFactory = $shipmentFactory;
        parent::__construct($context);
    }

    /**
     * Execute the save action.
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->redirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $model = $this->shipmentFactory->create();

            $model->setData($data);

            try {
                $this->messageManager->addSuccessMessage(__('Shipment saved successfully.'));
                $this->dataPersistor->clear('inpostinternational_shipment');

                $resultRedirect->setPath('*/*/index');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            $this->dataPersistor->set('inpostinternational_shipment', $data);
            $resultRedirect->setPath('*/*/create');
            return $resultRedirect;
        }
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }
}
