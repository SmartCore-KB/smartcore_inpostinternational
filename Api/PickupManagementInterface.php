<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Smartcore\InPostInternational\Api\Data\PickupInterface;

interface PickupManagementInterface
{
    /**
     * Get cutoff time
     *
     * @param string $postalCode
     * @param string $countryCode
     * @return mixed
     */
    public function getCutoffTime(string $postalCode, string $countryCode);

    /**
     * Create one-time pickup
     *
     * @param PickupInterface $pickup
     * @return mixed
     */
    public function createOneTimePickup(PickupInterface $pickup);

    /**
     * Cancel pickup
     *
     * @param string $pickupId
     * @return mixed
     */
    public function cancelPickup(string $pickupId);
}
