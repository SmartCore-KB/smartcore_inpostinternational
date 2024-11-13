<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element\Address;

use Smartcore\InPostInternational\Ui\Component\Form\Element\AbstractInput;

class City extends AbstractInput
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

        if (isset($config['dataScope']) && $config['dataScope'] == 'city') {
            $config['default'] = $this->order->getShippingAddress()->getCity();
            if (isset($data['city'])) {
                $config['default'] = $data['city'];
            }
            $this->setData('config', (array)$config);
        }
    }
}
