<?php

namespace Smartcore\InPostInternational\Model\Order;

use Magento\Catalog\Model\Product\Type;
use Magento\Sales\Api\OrderRepositoryInterface;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Registry\Order as OrderRegistry;

class Processor
{
    /**
     * @var mixed
     */
    protected $order;

    /**
     * @var ConfigProvider
     */
    protected $configProvider;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var OrderRegistry
     */
    protected $orderRegistry;

    /**
     * Processor constructor.
     *
     * @param ConfigProvider $configProvider
     * @param OrderRegistry $orderRegistry
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        ConfigProvider $configProvider,
        OrderRegistry $orderRegistry,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->configProvider = $configProvider;
        $this->orderRegistry = $orderRegistry;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Get the total weight of the order.
     *
     * @return float
     */
    public function getOrderWeight(): float
    {
        $weightAttributeCode = $this->configProvider->getWeightAttributeCode();
        $weight = 0;
        $store = $this->order->getStore();

        foreach ($this->order->getItems() as $item) {
            $product = $item->getProduct();

            if ($product->getTypeId() != Type::TYPE_SIMPLE) {
                continue;
            }

            $productWeight = $product->getResource()->getAttributeRawValue(
                (int)$item->getProductId(),
                (string)$weightAttributeCode,
                (int)$store->getId()
            );

            if (is_array($productWeight)) {
                $productWeight = 0;
            }
            $weight += $productWeight;
        }

        if ($this->configProvider->getWeightUnit() == 'g') {
            $weight = $weight / 1000;
        }

        return $weight;
    }

    /**
     * Get the street address of the order.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->order->getShippingAddress()->getStreetLine(1);
    }

    /**
     * Get the building number from the shipping address.
     *
     * @return string
     */
    public function getBuildingNumber(): string
    {
        $street = $this->order->getShippingAddress()->getStreet();
        if (isset($street[1])) {
            if (isset($street[2])) {
                return $this->order->getShippingAddress()->getStreetLine(2) .
                    '/' . $this->order->getShippingAddress()->getStreetLine(3);
            }
            return $this->order->getShippingAddress()->getStreetLine(2);
        }

        return $this->order->getShippingAddress()->getStreetLine(1);
    }

    /**
     * Set the order object.
     *
     * @param mixed $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get the order by ID.
     *
     * @param int $orderId
     * @return mixed
     */
    public function getOrder($orderId)
    {
        $order = $this->orderRegistry->get();
        if ($order->getId()) {
            $this->setOrder($order);
            return $order;
        }

        $order = $this->orderRepository->get($orderId);
        $this->orderRegistry->set($order);
        $this->setOrder($order);
        return $order;
    }
}
