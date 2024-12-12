<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\ShipmentInterface;
use Smartcore\InPostInternational\Api\ShipmentRepositoryInterface;
use Smartcore\InPostInternational\Model\ResourceModel\Shipment as ResourceModel;
use Smartcore\InPostInternational\Model\ResourceModel\Shipment\CollectionFactory;

class ShipmentRepository implements ShipmentRepositoryInterface
{

    /**
     * ShipmentRepository constructor.
     *
     * @param ResourceModel $resourceModel
     * @param ShipmentFactory $shipmentFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly ResourceModel     $resourceModel,
        private readonly ShipmentFactory   $shipmentFactory,
        private readonly CollectionFactory $collectionFactory,
    ) {
    }

    /**
     * Shipment save
     *
     * @param ShipmentInterface&AbstractModel $shipment
     * @return ShipmentInterface
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(ShipmentInterface $shipment): ShipmentInterface
    {
        $this->resourceModel->save($shipment);
        return $shipment;
    }

    /**
     * Shipment delete
     *
     * @param ShipmentInterface&AbstractModel $shipment
     * @return $this
     * @throws Exception
     */
    public function delete(ShipmentInterface $shipment): static
    {
        $this->resourceModel->delete($shipment);
        return $this;
    }

    /**
     * Load Shipment
     *
     * @param int $modelId
     * @return ShipmentInterface
     */
    public function load(int $modelId): ShipmentInterface
    {
        $shipment = $this->shipmentFactory->create();
        $this->resourceModel->load($shipment, $modelId);
        return $shipment;
    }

    /**
     * Get list of shipments
     *
     * @return array<mixed>
     */
    public function getList(): array
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}
