<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

class ParcelTemplate extends AbstractDefaultableResource
{
    /**
     * Parcel Template resource model constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inpostinternational_parcel_template', 'entity_id');
    }
}
