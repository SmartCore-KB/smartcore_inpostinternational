<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\WeightPriceInterface;
use Smartcore\InPostInternational\Api\WeightPriceRepositoryInterface;
use Smartcore\InPostInternational\Model\ResourceModel\WeightPrice as ResourceModel;
use Smartcore\InPostInternational\Model\ResourceModel\WeightPrice\CollectionFactory;

class WeightPriceRepository implements WeightPriceRepositoryInterface
{

    /**
     * WeightPriceRepository constructor.
     *
     * @param ResourceModel $resourceModel
     * @param WeightPriceFactory $weightPriceFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly ResourceModel      $resourceModel,
        private readonly WeightPriceFactory $weightPriceFactory,
        private readonly CollectionFactory  $collectionFactory,
    ) {
    }

    /**
     * WeightPrice save
     *
     * @param WeightPriceInterface&AbstractModel $weightPrice
     * @return WeightPriceInterface
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(WeightPriceInterface $weightPrice): WeightPriceInterface
    {
        $this->resourceModel->save($weightPrice);
        return $weightPrice;
    }

    /**
     * WeightPrice delete
     *
     * @param WeightPriceInterface&AbstractModel $weightPrice
     * @return $this
     * @throws Exception
     */
    public function delete(WeightPriceInterface $weightPrice): static
    {
        $this->resourceModel->delete($weightPrice);
        return $this;
    }

    /**
     * Load WeightPrice
     *
     * @param int $modelId
     * @return WeightPrice
     */
    public function load(int $modelId): WeightPrice
    {
        $weightPrice = $this->weightPriceFactory->create();
        $this->resourceModel->load($weightPrice, $modelId);
        return $weightPrice;
    }

    /**
     * Get list of weight-based prices
     *
     * @return array<mixed>
     */
    public function getList(): array
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}
