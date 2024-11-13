<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element\Address;

use Smartcore\InPostInternational\Ui\Component\Form\Element\AbstractInput;

class BuildingNumber extends AbstractInput
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

        if (isset($config['dataScope']) && $config['dataScope'] == 'building_number') {
            $config['default'] = $this->orderProcessor->getBuildingNumber();
            if (isset($data['building_number'])) {
                $config['default'] = $data['building_number'];
            }
            $this->setData('config', (array)$config);
        }
    }
}
