<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

interface SerializableInterface
{
    /**
     * Convert object to array
     *
     * @return array
     */
    public function toArray(): array;
}
