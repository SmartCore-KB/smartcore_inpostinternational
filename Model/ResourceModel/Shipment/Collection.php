<?php

namespace Smartcore\InPostInternational\Model\ResourceModel\Shipment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smartcore\InPostInternational\Api\Data\ShipmentInterface;
use Smartcore\InPostInternational\Model;
use Smartcore\InPostInternational\Model\Shipment;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = ShipmentInterface::ENTITY_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Shipment::class, Model\ResourceModel\Shipment::class);
    }
}
