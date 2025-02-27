<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class VolumeDto extends AbstractDto
{
    /**
     * @var string
     */
    public string $itemType;
    /**
     * @var int
     */
    public int $count;
    /**
     * @var TotalWeightDto
     */
    public TotalWeightDto $totalWeight;

    /**
     * Get item type
     *
     * @return string
     */
    public function getItemType(): string
    {
        return $this->itemType;
    }

    /**
     * Set item type
     *
     * @param string $itemType
     * @return $this
     */
    public function setItemType(string $itemType): static
    {
        $this->itemType = $itemType;
        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Set count
     *
     * @param int $count
     * @return $this
     */
    public function setCount(int $count): static
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Get total weight
     *
     * @return TotalWeightDto
     */
    public function getTotalWeight(): TotalWeightDto
    {
        return $this->totalWeight;
    }

    /**
     * Set total weight
     *
     * @param TotalWeightDto $totalWeight
     * @return $this
     */
    public function setTotalWeight(TotalWeightDto $totalWeight): static
    {
        $this->totalWeight = $totalWeight;
        return $this;
    }
}
