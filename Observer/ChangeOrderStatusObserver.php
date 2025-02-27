<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Smartcore\InPostInternational\Model\ConfigProvider;

class ChangeOrderStatusObserver extends AbstractOrderObserver implements ObserverInterface
{
    /**
     * ShipmentCreatedObserver constructor.
     *
     * @param ConfigProvider $configProvider
     * @param OrderRepository $orderRepository
     * @param PsrLoggerInterface $logger
     * @param MessageManagerInterface $messageManager
     */
    public function __construct(
        private readonly ConfigProvider          $configProvider,
        private readonly OrderRepository         $orderRepository,
        private readonly PsrLoggerInterface      $logger,
        private readonly MessageManagerInterface $messageManager,
    ) {
        parent::__construct($orderRepository, $logger, $messageManager);
    }

    /**
     * Observer for shipment create event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $status = $this->configProvider->getChangeOrderStatus();
        if (false === $status) {
            return;
        }
        $inpostShipment = $observer->getData('inpostInternationalShipment');
        try {
            $order = $this->getOrder($inpostShipment);
            if (!$order) {
                return;
            }
            $order->setStatus($status);
            $this->orderRepository->save($order);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
        }
    }
}
