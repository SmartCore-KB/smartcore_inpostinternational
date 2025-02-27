<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class WeightPrice extends AbstractDb
{
    /**
     * WeightPrice constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inpostinternational_weight_price', 'entity_id');
    }
}
