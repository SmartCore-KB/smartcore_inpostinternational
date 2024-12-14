<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\ShipmentFactory;

class PointToPointShipmentDtoFactory
{

    /**
     * PointToPointShipmentDto constructor
     *
     * @param ShipmentFactory $shipmentFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        private readonly ShipmentFactory $shipmentFactory,
        private readonly Context $context,
        private readonly Registry $registry,
        private readonly ?AbstractResource $resource = null,
        private readonly ?AbstractDb $resourceCollection = null
    ) {
    }

    /**
     * Create a new PointToPointShipmentDto instance
     *
     * @param array $data
     * @return PointToPointShipmentDto
     */
    public function create(array $data = []): PointToPointShipmentDto
    {
        return new PointToPointShipmentDto(
            $this->shipmentFactory,
            $this->context,
            $this->registry,
            $this->resource,
            $this->resourceCollection,
            $data
        );
    }
}
