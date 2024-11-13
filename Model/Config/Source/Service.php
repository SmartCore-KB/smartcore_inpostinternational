<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Service implements OptionSourceInterface
{
    /**
     * @var ShippingMethods
     */
    private ShippingMethods $shippingMethods;

    /**
     * Service constructor.
     *
     * @param ShippingMethods $shippingMethods
     */
    public function __construct(
        ShippingMethods $shippingMethods
    ) {
        $this->shippingMethods = $shippingMethods;
    }

    /**
     * Retrieve option array for services.
     *
     * @return array
     */
    public function toOptionArray() : array
    {
        $services = [];

        $methods = $this->shippingMethods->toOptionArray();

        foreach ($methods as $method) {
            $services[$method['value']] = ['value' => $method['value'], 'label' => __($method['label'])];
        }

        return $services;
    }

    /**
     * Get the label for a service.
     *
     * @param string $service
     * @return \Magento\Framework\Phrase
     */
    public function getServiceLabel($service)
    {
        $services = $this->toOptionArray();
        return (isset($services[$service])) ? __($services[$service]['label']) : $service;
    }
}
