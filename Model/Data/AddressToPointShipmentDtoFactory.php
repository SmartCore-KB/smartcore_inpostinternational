<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\PickupAddressRepository;
use Smartcore\InPostInternational\Model\ShipmentFactory;

class AddressToPointShipmentDtoFactory
{
    /**
     * AddressToPointShipmentDtoFactory constructor
     *
     * @param ShipmentFactory $shipmentFactory
     * @param AbstractDtoBuilder $abstractDtoBuilder
     * @param PickupAddressRepository $pickupAddrRepository
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        private readonly ShipmentFactory $shipmentFactory,
        private readonly AbstractDtoBuilder       $abstractDtoBuilder,
        private readonly PickupAddressRepository  $pickupAddrRepository,
        private readonly Context $context,
        private readonly Registry $registry,
        private readonly ?AbstractResource $resource = null,
        private readonly ?AbstractDb $resourceCollection = null
    ) {
    }

    /**
     * Create a new AddressToPointShipmentDto instance
     *
     * @return AddressToPointShipmentDto
     */
    public function create(): AddressToPointShipmentDto
    {
        return new AddressToPointShipmentDto(
            $this->shipmentFactory,
            $this->abstractDtoBuilder,
            $this->pickupAddrRepository,
            $this->context,
            $this->registry,
            $this->resource,
            $this->resourceCollection
        );
    }
}
