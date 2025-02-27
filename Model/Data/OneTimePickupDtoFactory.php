<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\PickupFactory;

class OneTimePickupDtoFactory
{
    /**
     * OneTimePickupDtoFactory constructor
     *
     * @param PickupFactory $pickupFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        private readonly PickupFactory     $pickupFactory,
        private readonly Context           $context,
        private readonly Registry          $registry,
        private readonly ?AbstractResource $resource = null,
        private readonly ?AbstractDb       $resourceCollection = null
    ) {
    }

    /**
     * Create a new OneTimePickupDto instance
     *
     * @return OneTimePickupDto
     */
    public function create(): OneTimePickupDto
    {
        return new OneTimePickupDto(
            $this->pickupFactory,
            $this->context,
            $this->registry,
            $this->resource,
            $this->resourceCollection
        );
    }
}
