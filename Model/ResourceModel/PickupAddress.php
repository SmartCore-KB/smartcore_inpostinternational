<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

class PickupAddress extends AbstractDefaultableResource
{
    /**
     * @var string
     */
    protected string $_eventPrefix = 'inpostinternational_pickup_address_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct(): void
    {
        $this->_init('inpostinternational_pickup_address', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
