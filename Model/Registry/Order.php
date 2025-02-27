<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Registry;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderInterfaceFactory;

class Order
{
    /**
     * @var OrderInterface
     */
    private OrderInterface $order;

    /**
     * @var OrderInterfaceFactory
     */
    private OrderInterfaceFactory $orderFactory;

    /**
     * Order constructor.
     *
     * @param OrderInterfaceFactory $orderFactory
     */
    public function __construct(OrderInterfaceFactory $orderFactory)
    {
        $this->orderFactory = $orderFactory;
    }

    /**
     * Set the order.
     *
     * @param OrderInterface $order
     * @return void
     */
    public function set(OrderInterface $order): void
    {
        $this->order = $order;
    }

    /**
     * Get the order.
     *
     * @return OrderInterface
     */
    public function get(): OrderInterface
    {
        return $this->order ?? $this->createNullOrder();
    }

    /**
     * Create a null order.
     *
     * @return OrderInterface
     */
    private function createNullOrder(): OrderInterface
    {
        return $this->orderFactory->create();
    }
}
