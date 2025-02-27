<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class PickupContactPerson extends Column
{

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array<string>
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = $item['contact_first_name'] . ' ' . $item['contact_last_name']
                    . '<br/>'
                    . $item['contact_email'] . '<br/>'
                    . $item['contact_phone_prefix'] . ' ' . $item['contact_phone_number'] . '<br/>';
            }
        }

        return $dataSource;
    }
}
