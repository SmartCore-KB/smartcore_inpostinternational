<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface PickupAddressInterface extends PickupCommonInterface
{

    public const LABEL = 'label';
    public const IS_DEFAULT = 'is_default';

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Set label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): self;

    /**
     * Get is default
     *
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * Set is default
     *
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): self;
}
