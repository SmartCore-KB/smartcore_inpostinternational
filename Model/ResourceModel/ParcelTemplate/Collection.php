<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel\ParcelTemplate;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smartcore\InPostInternational\Model\ParcelTemplate;
use Smartcore\InPostInternational\Model\ResourceModel\ParcelTemplate as ParcelTemplateResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Parcel Template collection constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            ParcelTemplate::class,
            ParcelTemplateResourceModel::class
        );
    }
}
