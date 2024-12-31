<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Smartcore\InPostInternational\Api\Data\OrderShipmentCreateInterfaceFactory;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Consumer;

class OrderObserver implements ObserverInterface
{
    /**
     * OrderObserver constructor.
     *
     * @param PublisherInterface $publisher
     * @param OrderShipmentCreateInterfaceFactory $shipmCreateFactory
     * @param ConfigProvider $configProvider
     */
    public function __construct(
        private readonly PublisherInterface                  $publisher,
        private readonly OrderShipmentCreateInterfaceFactory $shipmCreateFactory,
        private readonly ConfigProvider                      $configProvider
    ) {
    }

    /**
     * Observer for order create event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        if (!$this->configProvider->isAutoInpostshipmentCreateEnabled()) {
            return;
        }

        $order = $observer->getEvent()->getOrder();

        if (!$this->configProvider->isInpostShippingMethod($order->getShippingMethod())) {
            return;
        }

        $orderShipmentCreate = $this->shipmCreateFactory->create();
        $orderShipmentCreate->setOrderIncrementId($order->getIncrementId());

        $this->publisher->publish(Consumer::INPOSTINTERNATIONAL_ORDER_SHIPMENT_CREATE, $orderShipmentCreate);
    }
}
