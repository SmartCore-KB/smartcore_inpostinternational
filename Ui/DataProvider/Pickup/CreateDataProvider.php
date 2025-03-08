<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\DataProvider\Pickup;

use Magento\Framework\Session\SessionManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Smartcore\InPostInternational\Model\Config\Source\ParcelWeightUnit;
use Smartcore\InPostInternational\Model\Config\Source\VolumeItemType;
use Smartcore\InPostInternational\Model\PickupAddressRepository;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup\Collection;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup\CollectionFactory;
use Smartcore\InPostInternational\Service\OneTimePickupProcessor;

class CreateDataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;
    /**
     * @var array<mixed>
     */
    protected array $loadedData = [];

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param PickupAddressRepository $pickupAddrRepository
     * @param VolumeItemType $volumeItemType
     * @param ParcelWeightUnit $parcelWeightUnit
     * @param SessionManagerInterface $sessionManager
     * @param array $meta
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        private PickupAddressRepository  $pickupAddrRepository,
        private VolumeItemType $volumeItemType,
        private ParcelWeightUnit $parcelWeightUnit,
        private SessionManagerInterface $sessionManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array<mixed>
     */
    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = [OneTimePickupProcessor::PICKUP_FIELDSET => $model->getData()];
        }

        $data = $this->sessionManager->getFormData(true);
        if (!empty($data[OneTimePickupProcessor::PICKUP_FIELDSET])) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data[OneTimePickupProcessor::PICKUP_FIELDSET]);
            $this->loadedData[$model->getId()] = [OneTimePickupProcessor::PICKUP_FIELDSET => $model->getData()];
        }

        $pickupAddrDefaultId = $this->pickupAddrRepository->getDefaultId();
        $defaultData = [null => [
            OneTimePickupProcessor::PICKUP_FIELDSET => [
                'pickup_address' => $pickupAddrDefaultId,
                'volume_item_type' => $this->volumeItemType->toOptionArray()[0]['value'],
                'volume_weight_unit' => $this->parcelWeightUnit->toOptionArray()[0]['value'],
            ],
        ]];

        return count($this->loadedData) ? $this->loadedData : $defaultData;
    }
}
