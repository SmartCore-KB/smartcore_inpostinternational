<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Recipient extends Column
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
                $companyName = $item['recipient_company_name'] ? $item['recipient_company_name'] . '<br/>' : '';
                $item[$this->getData('name')] = $companyName
                    . $item['recipient_first_name'] . ' ' . $item['recipient_last_name'] . '<br/>'
                    . $item['recipient_email'] . '<br/>'
                    . $item['recipient_phone_prefix'] . ' ' . $item['recipient_phone_number'];
            }
        }

        return $dataSource;
    }
}
