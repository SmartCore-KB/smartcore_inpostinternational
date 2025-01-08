<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Observer;

use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Smartcore\InPostInternational\Model\Shipment;

abstract class AbstractOrderObserver
{
    /**
     * CreateOrderShipmentObserver constructor.
     *
     * @param OrderRepository $orderRepository
     * @param PsrLoggerInterface $logger
     * @param MessageManagerInterface $messageManager
     */
    public function __construct(
        private readonly OrderRepository         $orderRepository,
        private readonly PsrLoggerInterface      $logger,
        private readonly MessageManagerInterface $messageManager,
    ) {
    }

    /**
     * Get order from observer
     *
     * @param Shipment $inpostShipment
     * @return Order
     * @throws InputException
     * @throws NoSuchEntityException
     */
    protected function getOrder(Shipment $inpostShipment): Order
    {
        $orderId = $inpostShipment->getOrderId();
        try {
            /** @var Order $order */
            $order = $this->orderRepository->get($orderId);
            return $order;
        } catch (InputException|NoSuchEntityException $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
            throw $e;
        }
    }
}
