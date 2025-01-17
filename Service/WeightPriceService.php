<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use Magento\Framework\Exception\LocalizedException;
use Smartcore\InPostInternational\Model\ResourceModel\WeightPrice\CollectionFactory;

class WeightPriceService
{
    /**
     * WeightPriceService constructor.
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private readonly CollectionFactory $collectionFactory
    ) {
    }

    /**
     * Validate weight ranges
     *
     * @param float $weightFrom
     * @param float|null $weightTo
     * @param int|null $excludeId
     * @return void
     * @throws LocalizedException
     */
    public function validateWeightRanges(float $weightFrom, ?float $weightTo, ?int $excludeId = null): void
    {
        if ($weightTo) {
            if ($weightFrom >= $weightTo) {
                throw new LocalizedException(
                    __('Weight from value must be less than weight to value.')
                );
            }
            $conditions = [
                sprintf('(weight_from <= %f AND weight_to >= %f)', $weightTo, $weightTo),
                sprintf('(weight_from <= %f AND weight_to >= %f)', $weightFrom, $weightFrom),
                sprintf('(weight_from >= %f AND weight_to <= %f)', $weightFrom, $weightTo),
                sprintf('(weight_from <= %f AND weight_to IS NULL)', $weightTo),
            ];
        }

        if (!$weightTo) {
            $conditions = [
                sprintf('(weight_to >= %f)', $weightFrom),
                '(weight_to = NULL)',
            ];
        }

        $whereClause = '(' . implode(' OR ', $conditions) . ')';

        $collection = $this->collectionFactory->create();
        $collection->getSelect()->where($whereClause);

        if ($excludeId) {
            $collection->addFieldToFilter('entity_id', ['neq' => $excludeId]);
        }

        if ($collection->getSize() > 0) {
            $overlappingRange = $collection->getFirstItem();
            throw new LocalizedException(
                __(
                    'Weight range overlaps with existing range (from: %1, to: %2)',
                    $overlappingRange->getWeightFrom(),
                    $overlappingRange->getWeightTo() ?? __('max')
                )
            );
        }
    }
}
