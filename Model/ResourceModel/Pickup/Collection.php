<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel\Pickup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smartcore\InPostInternational\Model\Pickup as Model;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'inpostinternational_pickup_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct(): void
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
