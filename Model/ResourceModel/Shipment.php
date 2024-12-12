<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Smartcore\InPostInternational\Api\Data\ShipmentInterface;

class Shipment extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inpostinternational_shipment', ShipmentInterface::ENTITY_ID);
    }
}
