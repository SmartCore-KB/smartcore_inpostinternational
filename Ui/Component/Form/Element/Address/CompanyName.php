<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element\Address;

use Smartcore\InPostInternational\Ui\Component\Form\Element\AbstractInput;

class CompanyName extends AbstractInput
{

    /**
     * Prepare component configuration
     *
     * @return void
     */
    public function prepare()
    {
        parent::prepare();

        $config = $this->getData('config');
        $data= $this->request->getParams();

        if (isset($config['dataScope']) && $config['dataScope'] == 'company_name') {
            $config['default'] = $this->order->getShippingAddress()->getCompany();
            if (isset($data['company_name'])) {
                $config['default'] = $data['company_name'];
            }
            $this->setData('config', (array)$config);
        }
    }
}
