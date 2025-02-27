<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\PickupAddressInterface;
use Smartcore\InPostInternational\Api\PickupAddressRepositoryInterface;
use Smartcore\InPostInternational\Model\ResourceModel\PickupAddress as ResourceModel;
use Smartcore\InPostInternational\Model\ResourceModel\PickupAddress\CollectionFactory;

class PickupAddressRepository implements PickupAddressRepositoryInterface
{

    /**
     * PickupAddressRepository constructor.
     *
     * @param ResourceModel $resourceModel
     * @param PickupAddressFactory $pickupAddressFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly ResourceModel        $resourceModel,
        private readonly PickupAddressFactory $pickupAddressFactory,
        private readonly CollectionFactory    $collectionFactory,
    ) {
    }

    /**
     * PickupAddress save
     *
     * @param PickupAddressInterface&AbstractModel $pickupAddress
     * @return PickupAddressInterface
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(PickupAddressInterface $pickupAddress): PickupAddressInterface
    {
        $this->resourceModel->save($pickupAddress);
        return $pickupAddress;
    }

    /**
     * PickupAddress delete
     *
     * @param PickupAddressInterface&AbstractModel $pickupAddress
     * @return $this
     * @throws Exception
     */
    public function delete(PickupAddressInterface $pickupAddress): static
    {
        $this->resourceModel->delete($pickupAddress);
        return $this;
    }

    /**
     * Load PickupAddress
     *
     * @param int $modelId
     * @return PickupAddress
     */
    public function load(int $modelId): PickupAddress
    {
        $pickupAddress = $this->pickupAddressFactory->create();
        $this->resourceModel->load($pickupAddress, $modelId);
        return $pickupAddress;
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
