<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class TrackingNumber extends Column
{
    /**
     * TrackingNumber constructor.
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['tracking_number'])) {
                    $item['tracking_number_tmp'] = $item['tracking_number'];
                    $item['tracking_number'] =
                        '<a target="blank" href="https://inpost.pl/sledzenie-przesylek?number='
                        . $item['tracking_number'] . '">' . $item['tracking_number'] . '</a>';
                }
            }
        }

        return $dataSource;
    }
}
