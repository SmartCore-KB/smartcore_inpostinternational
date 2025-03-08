<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

class TransferInpostPointToOrder implements ObserverInterface
{
    /**
     * Transfer InPost point data from quote to order
     *
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        /** @var Order $order */
        $order = $observer->getEvent()->getOrder();
        /** @var Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        $lockerId = $quote->getInpostinternationalLockerId();
        if ($lockerId) {
            $order->setInpostinternationalLockerId($lockerId);
        }

        $lockerData = $quote->getInpostinternationalLockerData();
        if ($lockerData) {
            $order->setInpostinternationalLockerData($lockerData);
        }

        return $this;
    }
}
