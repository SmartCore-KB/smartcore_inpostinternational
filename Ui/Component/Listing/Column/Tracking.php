<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Smartcore\InPostInternational\Model\ConfigProvider;

class Tracking extends Column
{
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param ConfigProvider $configProvider
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface                $context,
        UiComponentFactory              $uiComponentFactory,
        private readonly ConfigProvider $configProvider,
        array                           $components = [],
        array                           $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = '<a target="blank" href="'
                    . $this->configProvider->getInPostTrackingLink() . $item['tracking_number']
                    . '">' . $item['tracking_number'] . '</a>';
            }
        }

        return $dataSource;
    }
}
