<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Service\ShipmentProcessor;

class MassCreateShipment extends Action
{

    /**
     * MassCreateShipment constructor
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ShipmentProcessor $shipmentProcessor
     */
    public function __construct(
        Context                            $context,
        private readonly Filter            $filter,
        private readonly CollectionFactory $collectionFactory,
        private readonly ShipmentProcessor $shipmentProcessor,
    ) {
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @throws TokenSaveException
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $shipmentsCreated = 0;

        foreach ($collection as $order) {
            try {
                $this->shipmentProcessor->createInPostShipmentForOrder((int) $order->getId());
                $shipmentsCreated++;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(
                    __(
                        'Error during InPost International shipment creation for order ID %1: %2',
                        $order->getIncrementId(),
                        $e->getMessage()
                    )->render()
                );
            }
        }

        $this->messageManager->addSuccessMessage(
            __('%1 InPost International shipments created.', $shipmentsCreated)->render()
        );

        /** @var Redirect $resultRedirect */
        // @phpstan-ignore-next-line
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('sales/order/index');
    }

    /**
     * Check if user has permissions to visit the controller
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::shipments_index');
    }
}
