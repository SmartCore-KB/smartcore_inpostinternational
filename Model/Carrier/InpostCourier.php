<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Carrier;

use Magento\Framework\DataObject;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\ResultFactory;

class InpostCourier extends AbstractCarrier implements CarrierInterface
{
    private const METHOD_CODE = 'inpostcourier';
    /**
     * @var ResultFactory
     */
    protected $_rateResultFactory;
    /**
     * @var MethodFactory
     */
    protected $_rateMethodFactory;

    /**
     * If tracking is available
     *
     * @return bool
     */
    public function isTrackingAvailable(): bool
    {
        return true;
    }

    /**
     * Get allowed shipping methods
     *
     * @inheritdoc
     */
    public function getAllowedMethods()
    {
        return [self::METHOD_CODE => $this->getConfigData('name')];
    }

    /**
     * Collect and get rates
     *
     * @param RateRequest $request
     * @return DataObject|bool|null
     */
    public function collectRates(RateRequest $request): DataObject|bool|null
    {

        /** @var Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier('freeshipping');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('freeshipping');
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice('0.00');
        $method->setCost('0.00');

        $result->append($method);

        return $result;
    }
}
