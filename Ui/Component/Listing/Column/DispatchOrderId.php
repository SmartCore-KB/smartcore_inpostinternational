<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class DispatchOrderId extends Column
{
    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['sending_method'] != 'dispatch_order') {
                    $item['dispatch_order_id'] = __('Not applicable');
                }
            }
        }

        return $dataSource;
    }
}
