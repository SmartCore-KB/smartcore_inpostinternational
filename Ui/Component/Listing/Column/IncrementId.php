<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class IncrementId extends Column
{
    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * TrackingNumber constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array<mixed>
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['increment_id'])) {
                    $url = $this->urlBuilder->getUrl('sales/order/view', ['order_id' => $item['order_id']]);
                    $item['increment_id'] =
                        '<a target="blank" href="' . $url . '">' . $item['increment_id'] . '</a>';
                }
            }
        }

        return $dataSource;
    }
}
