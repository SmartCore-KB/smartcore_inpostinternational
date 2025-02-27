<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

class Pickup extends AbstractDefaultableResource
{
    /**
     * @var string
     */
    protected string $_eventPrefix = 'inpostinternational_pickup_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct(): void
    {
        $this->_init('inpostinternational_pickup', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
