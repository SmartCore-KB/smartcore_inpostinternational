<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface TrackingEventInterface
{
    /**
     * Get date
     *
     * @return string
     */
    public function getDate();

    /**
     * Set date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date);

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
     * Get description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     *
     * @param string|null $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Get location
     *
     * @return string|null
     */
    public function getLocation();

    /**
     * Set location
     *
     * @param string|null $location
     * @return $this
     */
    public function setLocation($location);
}
