<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface TrackingInterface
{
    /**
     * Get tracking number
     *
     * @return string
     */
    public function getTrackingNumber();

    /**
     * Set tracking number
     *
     * @param string $trackingNumber
     * @return $this
     */
    public function setTrackingNumber($trackingNumber);

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get tracking events
     *
     * @return TrackingEventInterface[]
     */
    public function getTrackingEvents();

    /**
     * Set tracking events
     *
     * @param TrackingEventInterface[] $trackingEvents
     * @return $this
     */
    public function setTrackingEvents(array $trackingEvents);

    /**
     * Get estimated delivery date
     *
     * @return string|null
     */
    public function getEstimatedDeliveryDate();

    /**
     * Set estimated delivery date
     *
     * @param string|null $estDeliveryDate
     * @return $this
     */
    public function setEstimatedDeliveryDate(?string $estDeliveryDate): static;
}
