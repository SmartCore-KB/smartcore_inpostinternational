<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class PickupVolume extends Column
{

    /**
     * Prepare Data Source
     *
     * @param array<string,mixed> $dataSource
     * @return array<string>
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = __('Packages:')->render() . ' ' . $item['volume_count']
                    . '<br/>' . __('Total weight:')->render() . ' ' . $item['volume_weight_amount']
                    . ' ' . $item['volume_weight_unit'] . '<br/>';
            }
        }

        return $dataSource;
    }
}
