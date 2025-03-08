<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class References
{
    /**
     * Custom references associated with the shipment
     *
     * @var array
     */
    public array $custom;

    /**
     * Get the custom references associated with the shipment
     *
     * @return array
     */
    public function getCustom(): array
    {
        return $this->custom;
    }

    /**
     * Set the custom references associated with the shipment
     *
     * @param array $custom
     * @return void
     */
    public function setCustom(array $custom): void
    {
        $this->custom = $custom;
    }
}
