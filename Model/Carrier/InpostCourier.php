<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Carrier;

use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Item;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Smartcore\InPostInternational\Setup\Patch\Data\AddProductBlockPointsAttribute;

class InpostCourier extends AbstractCarrier implements CarrierInterface
{
    /**
     * Carrier code
     *
     * @var string
     */
    protected $_code = 'inpostinternationalcourier';

    /**
     * @var string
     */
    protected string $_method = 'courier';

    /**
     * Constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param StoreManagerInterface $storeManager
     * @param ProductResource $productResource
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface    $scopeConfig,
        ErrorFactory            $rateErrorFactory,
        LoggerInterface         $logger,
        protected ResultFactory $rateResultFactory,
        protected MethodFactory $rateMethodFactory,
        protected StoreManagerInterface $storeManager,
        protected ProductResource $productResource,
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
     * @param RateRequest $request
     * @return Result|bool
     * @throws NoSuchEntityException
     */
    public function collectRates(RateRequest $request): Result|bool
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        if (!$this->isShippingMethodAvailable($request)) {
            return false;
        }

        $result = $this->rateResultFactory->create();

        /** @var Method $method */
        $method = $this->rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->_method);
        $method->setMethodTitle($this->getConfigData('name'));

        $shippingCost = $this->getConfigData('price');
        $method->setPrice($shippingCost);
        $method->setCost($shippingCost);

        $result->append($method);

        return $result;
    }

    /**
     * Check if shipping is available
     *
     * @param RateRequest $request
     * @return bool
     * @throws NoSuchEntityException
     */
    protected function isShippingMethodAvailable(RateRequest $request): bool
    {
        $items = $request->getAllItems();
        if (empty($items)) {
            return true;
        }

        $storeId = $this->storeManager->getStore()->getId();

        /** @var Item $item */
        foreach ($items as $item) {
            $blockShip = $this->productResource->getAttributeRawValue(
                $item->getProduct()->getId(),
                AddProductBlockPointsAttribute::BLOCK_INPOSTINTERNATIONAL_POINTS,
                $storeId
            );

            if ($blockShip) {
                return false;
            }
        }

        return true;
    }
}
