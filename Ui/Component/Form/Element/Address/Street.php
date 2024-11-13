<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element\Address;

use Smartcore\InPostInternational\Ui\Component\Form\Element\AbstractInput;

class Street extends AbstractInput
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

        if (isset($config['dataScope']) && $config['dataScope'] == 'street') {
            $config['default'] = $this->orderProcessor->getStreet();
            if (isset($data['street'])) {
                $config['default'] = $data['street'];
            }
            $this->setData('config', (array)$config);
        }
    }
}
