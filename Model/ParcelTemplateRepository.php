<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\ParcelTemplateInterface;
use Smartcore\InPostInternational\Api\ParcelTemplateRepositoryInterface;
use Smartcore\InPostInternational\Model\ResourceModel\ParcelTemplate as ResourceModel;

class ParcelTemplateRepository implements ParcelTemplateRepositoryInterface
{

    /**
     * ParcelTemplateRepository constructor.
     *
     * @param ResourceModel $resourceModel
     * @param ParcelTemplateFactory $parcelTmplFactory
     */
    public function __construct(
        private readonly ResourceModel $resourceModel,
        private readonly ParcelTemplateFactory $parcelTmplFactory
    ) {
    }

    /**
     * ParcelTemplate save
     *
     * @param ParcelTemplateInterface&AbstractModel $parcelTemplate
     * @return ParcelTemplateInterface
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(ParcelTemplateInterface $parcelTemplate): ParcelTemplateInterface
    {
        $this->resourceModel->save($parcelTemplate);
        return $parcelTemplate;
    }

    /**
     * ParcelTemplate delete
     *
     * @param ParcelTemplateInterface&AbstractModel $parcelTemplate
     * @return $this
     * @throws Exception
     */
    public function delete(ParcelTemplateInterface $parcelTemplate): static
    {
        $this->resourceModel->delete($parcelTemplate);
        return $this;
    }

    /**
     * Load ParcelTemplate
     *
     * @param int $modelId
     * @return ParcelTemplate
     */
    public function load(int $modelId): ParcelTemplate
    {
        $parcelTemplate = $this->parcelTmplFactory->create();
        $this->resourceModel->load($parcelTemplate, $modelId);
        return $parcelTemplate;
    }
}
