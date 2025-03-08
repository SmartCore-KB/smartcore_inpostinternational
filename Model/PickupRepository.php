<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\PickupInterface;
use Smartcore\InPostInternational\Api\PickupRepositoryInterface;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup as ResourceModel;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup\CollectionFactory;

class PickupRepository implements PickupRepositoryInterface
{

    /**
     * PickupRepository constructor.
     *
     * @param ResourceModel $resourceModel
     * @param PickupFactory $pickupFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly ResourceModel        $resourceModel,
        private readonly PickupFactory $pickupFactory,
        private readonly CollectionFactory    $collectionFactory,
    ) {
    }

    /**
     * Pickup save
     *
     * @param PickupInterface&AbstractModel $pickup
     * @return PickupInterface
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(PickupInterface $pickup): PickupInterface
    {
        $this->resourceModel->save($pickup);
        return $pickup;
    }

    /**
     * Pickup delete
     *
     * @param PickupInterface&AbstractModel $pickup
     * @return $this
     * @throws Exception
     */
    public function delete(PickupInterface $pickup): static
    {
        $this->resourceModel->delete($pickup);
        return $this;
    }

    /**
     * Load Pickup
     *
     * @param int $modelId
     * @return Pickup
     */
    public function load(int $modelId): Pickup
    {
        $pickup = $this->pickupFactory->create();
        $this->resourceModel->load($pickup, $modelId);
        return $pickup;
    }

    /**
     * Get list of Parcel Templates
     *
     * @return array<mixed>
     */
    public function getList(): array
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }

    /**
     * Get default Parcel Template ID
     *
     * @return int|null
     */
    public function getDefaultId(): ?int
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('is_default', ['eq' => 1]);
        return (int)$collection->getFirstItem()->getId();
    }
}
