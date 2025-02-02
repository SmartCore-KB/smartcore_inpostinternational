<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\DataProvider\Pickup;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Smartcore\InPostInternational\Model\ResourceModel\Pickup\CollectionFactory;

class ListingDataProvider extends AbstractDataProvider
{
    /**
     * ListingDataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
