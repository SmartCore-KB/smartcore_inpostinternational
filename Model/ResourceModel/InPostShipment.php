<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Smartcore\InPostInternational\Api\Data\InPostShipmentInterface;

class InPostShipment extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('inpostinternational_shipment', InPostShipmentInterface::ENTITY_ID);
    }
}
