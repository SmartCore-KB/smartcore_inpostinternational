<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

interface TrackingManagementInterface
{
    /**
     * Get tracking info
     *
     * @param string $trackingNumber
     * @return mixed
     */
    public function getTrackingInfo(string $trackingNumber);
}
