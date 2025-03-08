<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\InPostShipmentInterface;
use Smartcore\InPostInternational\Api\ShipmentRepositoryInterface;
use Smartcore\InPostInternational\Model\ResourceModel\InPostShipment as ResourceModel;
use Smartcore\InPostInternational\Model\ResourceModel\InPostShipment\CollectionFactory;

class InPostShipmentRepository implements ShipmentRepositoryInterface
{

    /**
     * ShipmentRepository constructor.
     *
     * @param ResourceModel $resourceModel
     * @param InPostShipmentFactory $shipmentFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly ResourceModel     $resourceModel,
        private readonly InPostShipmentFactory   $shipmentFactory,
        private readonly CollectionFactory $collectionFactory,
    ) {
    }

    /**
     * Shipment save
     *
     * @param InPostShipmentInterface&AbstractModel $shipment
     * @return InPostShipmentInterface
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(InPostShipmentInterface $shipment): InPostShipmentInterface
    {
        $this->resourceModel->save($shipment);
        return $shipment;
    }

    /**
     * Shipment delete
     *
     * @param InPostShipmentInterface&AbstractModel $shipment
     * @return $this
     * @throws Exception
     */
    public function delete(InPostShipmentInterface $shipment): static
    {
        $this->resourceModel->delete($shipment);
        return $this;
    }

    /**
     * Load Shipment
     *
     * @param int $modelId
     * @return InPostShipmentInterface
     */
    public function load(int $modelId): InPostShipmentInterface
    {
        $shipment = $this->shipmentFactory->create();
        $this->resourceModel->load($shipment, $modelId);
        return $shipment;
    }

    /**
     * Get list of shipments
     *
     * @param string|null $updatedSince
     * @return array<mixed>
     */
    public function getList(?string $updatedSince = null): array
    {
        $collection = $this->collectionFactory->create();

        if ($updatedSince) {
            $collection->addFieldToFilter('updated_at', ['gteq' => $updatedSince]);
        }

        return $collection->getItems();
    }

    /**
     * Get list of shipments by order ID
     *
     * @param string $orderId
     * @return array<mixed>
     */
    public function getListByOrderId(string $orderId): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('order_id', $orderId);

        return $collection->getItems();
    }
}
