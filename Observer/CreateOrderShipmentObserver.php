<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException as LocalizedException;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Sales\Api\Data\ShipmentTrackInterfaceFactory;
use Magento\Sales\Model\Convert\Order as ConvertOrder;
use Magento\Sales\Model\Order\ShipmentRepository;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Smartcore\InPostInternational\Model\Carrier\InpostCourier;
use Smartcore\InPostInternational\Model\ConfigProvider;

class CreateOrderShipmentObserver extends AbstractOrderObserver implements ObserverInterface
{
    /**
     * CreateOrderShipmentObserver constructor.
     *
     * @param ConfigProvider $configProvider
     * @param OrderRepository $orderRepository
     * @param PsrLoggerInterface $logger
     * @param ConvertOrder $convertOrder
     * @param ShipmentTrackInterfaceFactory $trackFactory
     * @param ShipmentRepository $shipmentRepository
     * @param MessageManagerInterface $messageManager
     * @param InpostCourier $inpostCourier
     */
    public function __construct(
        private readonly ConfigProvider                $configProvider,
        private readonly OrderRepository               $orderRepository,
        private readonly PsrLoggerInterface            $logger,
        private readonly ConvertOrder                  $convertOrder,
        private readonly ShipmentTrackInterfaceFactory $trackFactory,
        private readonly ShipmentRepository            $shipmentRepository,
        private readonly MessageManagerInterface       $messageManager,
        private readonly InpostCourier                 $inpostCourier,
    ) {
        parent::__construct($orderRepository, $logger, $messageManager);
    }

    /**
     * Observer for creating shipment for the order
     *
     * @param Observer $observer
     * @return void
     * @throws LocalizedException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function execute(Observer $observer): void
    {
        $status = $this->configProvider->isAutoOrderShipmentCreateEnabled();
        if (false === $status) {
            return;
        }
        $inpostShipment = $observer->getData('inpostInternationalShipment');
        try {
            $order = $this->getOrder($inpostShipment);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
            return;
        }

        $orderShipment = $order->getShipmentsCollection()->getFirstItem();
        if (!$orderShipment->getId()) {
            if (!$order->canShip()) {
                throw new LocalizedException(
                    __('You can\'t create an shipment for order %1.', $order->getIncrementId())
                );
            }
            $orderShipment = $this->convertOrder->toShipment($order);
            foreach ($order->getAllItems() as $orderItem) {
                if (!$orderItem->getQtyToShip() || $orderItem->getIsVirtual()) {
                    continue;
                }
                $qtyShipped = $orderItem->getQtyToShip();
                $shipmentItem = $this->convertOrder->itemToShipmentItem($orderItem)->setQty($qtyShipped);
                $orderShipment->addItem($shipmentItem);
            }
            $orderShipment->register();
        }

        // create track
        $trackTitle = $this->configProvider->getShippingMethodTitle();
        $carrierCode = $this->inpostCourier->getCarrierCode();
        $data = [
            'carrier_code' => $carrierCode,
            'title' => $trackTitle,
            'number' => $inpostShipment->getTrackingNumber()
        ];
        $track = $this->trackFactory->create();
        // @phpstan-ignore-next-line
        $track->addData($data);
        // @phpstan-ignore-next-line
        $orderShipment->addTrack($track);

        // support to MSI
        // if MSI has been disabled or removed then setSourceCode method does not exists
        if (method_exists($orderShipment->getExtensionAttributes(), 'setSourceCode')) {
            $orderShipment->getExtensionAttributes()->setSourceCode('default');
        }

        // save order and shipment
        try {
            $this->orderRepository->save($order);
            // @phpstan-ignore-next-line
            $this->shipmentRepository->save($orderShipment);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
        }
    }
}
