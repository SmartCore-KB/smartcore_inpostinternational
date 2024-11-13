<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Carrier;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;
use Psr\Log\LoggerInterface;

class InpostCourier extends AbstractCarrier implements CarrierInterface
{
    /**
     * Carrier code
     *
     * @var string
     */
    protected $_code = 'inpostinternationalcourier';

    /**
     * Constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface    $scopeConfig,
        ErrorFactory            $rateErrorFactory,
        LoggerInterface         $logger,
        protected ResultFactory $rateResultFactory,
        protected MethodFactory $rateMethodFactory,
        array                   $data = []
    ) {
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Check if tracking is available for the carrier
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
     * @return array<string>
     */
    public function getAllowedMethods(): array
    {
        return [$this->_code => $this->getConfigData('name')];
    }

    /**
     * Collect and get shipping rates based on the request
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param RateRequest $request
     * @return Result|bool
     */
    public function collectRates(RateRequest $request): Result|bool
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $result = $this->rateResultFactory->create();

        /** @var Method $method */
        $method = $this->rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('courier');
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice('0.00');

        $result->append($method);

        return $result;
    }
}
