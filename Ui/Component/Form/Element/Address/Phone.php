<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element\Address;

use Smartcore\InPostInternational\Ui\Component\Form\Element\AbstractInput;

class Phone extends AbstractInput
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

        if (isset($config['dataScope']) && $config['dataScope'] == 'phone') {
            $config['default'] = $this->order->getShippingAddress()->getTelephone();
            if (isset($data['phone'])) {
                $config['default'] = $data['phone'];
            }
            $this->setData('config', (array)$config);
        }
    }
}
