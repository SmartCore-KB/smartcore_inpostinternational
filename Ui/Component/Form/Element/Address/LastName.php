<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element\Address;

use Smartcore\InPostInternational\Ui\Component\Form\Element\AbstractInput;

class LastName extends AbstractInput
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

        if (isset($config['dataScope']) && $config['dataScope'] == 'last_name') {
            $config['default'] = $this->order->getShippingAddress()->getLastname();
            if (isset($data['last_name'])) {
                $config['default'] = $data['last_name'];
            } elseif ($this->order->getCustomerLastname()) {
                $config['default'] = $this->order->getCustomerLastname();
            }
            $this->setData('config', (array)$config);
        }
    }
}
