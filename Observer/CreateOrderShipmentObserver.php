<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException as LocalizedException;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Sales\Api\Data\ShipmentTrackInterfaceFactory;
use Magento\Sales\Model\Convert\Order as ConvertOrder;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Shipment;
use Magento\Sales\Model\Order\ShipmentRepository;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Smartcore\InPostInternational\Model\Carrier\InpostCourier;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\InPostShipment as InpostShipment;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
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
        if (!$this->configProvider->isAutoOrderShipmentCreateEnabled()) {
            return;
        }

        /** @var InpostShipment $inpostShipment */
        $inpostShipment = $observer->getData('inpostInternationalShipment');
        $order = $this->getOrderOrLogError($inpostShipment);
        if (!$order) {
            return;
        }

        $orderShipment = $this->getOrderShipment($order);

        $this->createTrack($orderShipment, $inpostShipment);
        $this->setSourceCode($orderShipment);
        $this->saveOrderAndShipment($order, $orderShipment);
    }

    /**
     * Get order or log error
     *
     * @param InpostShipment $inpostShipment
     * @return Order|null
     */
    private function getOrderOrLogError(InpostShipment $inpostShipment): ?Order
    {
        try {
            return $this->getOrder($inpostShipment);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
            return null;
        }
    }

    /**
     * Get order shipment
     *
     * @param Order $order
     * @return Shipment
     * @throws LocalizedException
     */
    private function getOrderShipment(Order $order): Shipment
    {
        $orderShipment = $order->getShipmentsCollection()->getFirstItem();
        if (!$orderShipment->getId()) {
            if (!$order->canShip()) {
                throw new LocalizedException(
                    __('You can\'t create a shipment for order %1.', $order->getIncrementId())
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
        return $orderShipment;
    }

    /**
     * Create track
     *
     * @param Shipment $orderShipment
     * @param InpostShipment $inpostShipment
     * @return void
     */
    private function createTrack(Shipment $orderShipment, InpostShipment $inpostShipment): void
    {
        $trackTitle = $this->configProvider->getShippingMethodTitle();
        $carrierCode = $this->inpostCourier->getCarrierCode();
        $data = [
            'carrier_code' => $carrierCode,
            'title' => $trackTitle,
            'number' => $inpostShipment->getTrackingNumber()
        ];
        $track = $this->trackFactory->create();
        $track->addData($data);
        $orderShipment->addTrack($track);
    }

    /**
     * Set source code
     *
     * @param Shipment $orderShipment
     * @return void
     */
    private function setSourceCode(Shipment $orderShipment): void
    {
        /** @phpstan-ignore-next-line */
        $extensionAttributes = $orderShipment->getExtensionAttributes();
        if (method_exists($extensionAttributes, 'setSourceCode')) {
            /** @phpstan-ignore-next-line */
            $extensionAttributes->setSourceCode('default');
        }
    }

    /**
     * Save order and shipment
     *
     * @param Order $order
     * @param Shipment $orderShipment
     * @return void
     */
    private function saveOrderAndShipment(Order $order, Shipment $orderShipment): void
    {
        try {
            $this->orderRepository->save($order);
            $this->shipmentRepository->save($orderShipment);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
        }
    }
}
