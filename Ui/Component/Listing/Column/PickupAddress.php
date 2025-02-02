<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class PickupAddress extends Column
{

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array<mixed>
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = $item['address_street'] . ' ' . $item['address_house_number']
                    . ' ' . $item['address_flat_number'] . '<br/>'
                    . $item['address_postal_code'] . ' ' . $item['address_city'] . '<br/>'
                    . $item['address_country_code'] . '<br/>' . $item['address_location_description'];
            }
        }

        return $dataSource;
    }
}
