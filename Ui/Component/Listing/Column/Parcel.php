<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Parcel extends Column
{

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
                $dimUnit = strtolower($item['parcel_dimensions_unit']);
                $comment = $item['parcel_label_comment'] ? $item['parcel_label_comment'] . '<br/>' : '';
                $barcode = $item['parcel_label_barcode'] ? $item['parcel_label_barcode'] . '<br/>' : '';
                $insurance = $item['insurance_value']
                    ? $item['insurance_value'] . ' ' . $item['insurance_currency']
                    : __('No')->getText();
                $item[$this->getData('name')] = round((float)$item['parcel_width'], 2) . $dimUnit
                    . ' x ' . round((float)$item['parcel_length']) . $dimUnit
                    . ' x ' . round((float)$item['parcel_height']) . $dimUnit . '<br/>'
                    . round((float)$item['parcel_weight']) . strtolower($item['parcel_weight_unit']) . '<br/>'
                    . $comment
                    . $barcode
                    . __('Insurance: ')->getText() . $insurance;
            }
        }

        return $dataSource;
    }
}
