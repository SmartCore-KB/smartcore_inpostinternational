<?php

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Model\ResourceModel\Shipment as ShipmentResourceModel;

class Shipment extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ShipmentResourceModel::class);
    }
}
