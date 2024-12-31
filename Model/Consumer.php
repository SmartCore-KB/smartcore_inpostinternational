<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Sales\Model\OrderFactory;
use Smartcore\InPostInternational\Api\Data\OrderShipmentCreateInterface;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Service\ShipmentProcessor;
use Throwable;

class Consumer
{
    public const string INPOSTINTERNATIONAL_ORDER_SHIPMENT_CREATE = 'inpostinternational.order.shipment.create';
    public const string INPOSTINTERNATIONAL_ORDER_SHIPMENT_CREATE_DLQ = 'inpostinternational.order.shipment.create.dlq';

    /**
     * Consumer constructor.
     *
     * @param OrderFactory $orderFactory
     * @param ShipmentProcessor $shipmentProcessor
     * @param PublisherInterface $publisher
     */
    public function __construct(
        private OrderFactory $orderFactory,
        private ShipmentProcessor $shipmentProcessor,
        private PublisherInterface $publisher,
    ) {
    }

    /**
     * Process message from queue
     *
     * @param OrderShipmentCreateInterface $message
     * @return void
     * @throws LocalizedException
     */
    public function processMessage(OrderShipmentCreateInterface $message): void
    {
        try {
            if (!$message->getOrderIncrementId()) {
                throw new LocalizedException(__('Order increment ID is missing.'));
            }

            $order = $this->orderFactory->create()->loadByIncrementId($message->getOrderIncrementId());
            if (!$order->getId()) {
                throw new LocalizedException(
                    __('Order not found for increment ID: %1', $message->getOrderIncrementId())
                );
            }

            $this->shipmentProcessor->createInPostShipmentForOrder((int) $order->getId());
        } catch (TokenSaveException $e) {
            $this->resendMessageToQueue($message, $e->getMessage());
        } catch (LocalizedException|Exception $e) {
            $this->sendMessageToDeadLetterQueue($message, $e->getMessage());
            throw new LocalizedException(__('Error processing message: %1', $e->getMessage()));
        } catch (Throwable $e) {
            $this->sendMessageToDeadLetterQueue($message, $e->getMessage());
            throw new LocalizedException(__('Unknown error: %1', $e->getMessage()));
        }
    }

    /**
     * Resend message to queue
     *
     * @param OrderShipmentCreateInterface $message
     * @param string $errorMessage
     * @return void
     */
    private function resendMessageToQueue(OrderShipmentCreateInterface $message, string $errorMessage): void
    {
        $message->setErrorMessage($errorMessage);
        $message->incrementReQueueCounter();
        if ($message->getReQueueCounter() > 10) {
            $this->sendMessageToDeadLetterQueue($message, 'Requeue counter exceeded!. ' . $errorMessage);
            return;
        }
        $this->publisher->publish(self::INPOSTINTERNATIONAL_ORDER_SHIPMENT_CREATE, $message);
    }

    /**
     * Send message to dead letter queue
     *
     * @param OrderShipmentCreateInterface $message
     * @param string $errorMessage
     * @return void
     */
    private function sendMessageToDeadLetterQueue(OrderShipmentCreateInterface $message, string $errorMessage): void
    {
        $message->setErrorMessage($errorMessage);
        $this->publisher->publish(self::INPOSTINTERNATIONAL_ORDER_SHIPMENT_CREATE_DLQ, $message);
    }
}
