<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class PickupTimeDto extends AbstractDto
{
    /**
     * @var string
     */
    public string $from;

    /**
     * @var string
     */
    public string $to;

    /**
     * Get pickup time from
     *
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * Set pickup time from
     *
     * @param string $from
     * @return $this
     */
    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get pickup time to
     *
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * Set pickup time to
     *
     * @param string $to
     * @return $this
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }
}
