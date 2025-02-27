<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel\InPostShipment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smartcore\InPostInternational\Api\Data\InPostShipmentInterface;
use Smartcore\InPostInternational\Model\InPostShipment;
use Smartcore\InPostInternational\Model\ResourceModel\InPostShipment as InPostShipmentResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = InPostShipmentInterface::ENTITY_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(InPostShipment::class, InPostShipmentResourceModel::class);
    }
}
