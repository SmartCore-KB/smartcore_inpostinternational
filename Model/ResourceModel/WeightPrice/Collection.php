<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel\WeightPrice;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smartcore\InPostInternational\Model\ResourceModel\WeightPrice as ResourceModel;
use Smartcore\InPostInternational\Model\WeightPrice as Model;

class Collection extends AbstractCollection
{
    /**
     * Collection constructor.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
