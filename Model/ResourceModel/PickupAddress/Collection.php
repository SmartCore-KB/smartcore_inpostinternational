<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel\PickupAddress;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smartcore\InPostInternational\Model\PickupAddress as Model;
use Smartcore\InPostInternational\Model\ResourceModel\PickupAddress as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'inpostinternational_pickup_address_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
