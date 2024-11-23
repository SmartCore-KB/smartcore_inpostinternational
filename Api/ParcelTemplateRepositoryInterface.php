<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\ParcelTemplateInterface;

interface ParcelTemplateRepositoryInterface
{
    /**
     * Save Parcel Template
     *
     * @param ParcelTemplateInterface&AbstractModel $parcelTemplate
     * @return ParcelTemplateInterface
     */
    public function save(ParcelTemplateInterface $parcelTemplate): ParcelTemplateInterface;

    /**
     * Delete Parcel Template
     *
     * @param ParcelTemplateInterface&AbstractModel $parcelTemplate
     * @return $this
     */
    public function delete(ParcelTemplateInterface $parcelTemplate): static;

    /**
     * Load Parcel Template
     *
     * @param int $modelId
     * @return ParcelTemplateInterface
     */
    public function load(int $modelId): ParcelTemplateInterface;
}
