<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Carrier;

use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Item;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Smartcore\InPostInternational\Model\Config\Source\PriceCalculationType;
use Smartcore\InPostInternational\Model\ResourceModel\WeightPrice\CollectionFactory as WeightPriceCollectionFactory;
use Smartcore\InPostInternational\Setup\Patch\Data\AddProductBlockPointsAttribute;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
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
     * @param WeightPriceCollectionFactory $weightPriceColFactor
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface                   $scopeConfig,
        ErrorFactory                           $rateErrorFactory,
        LoggerInterface                        $logger,
        protected ResultFactory                $rateResultFactory,
        protected MethodFactory                $rateMethodFactory,
        protected StoreManagerInterface        $storeManager,
        protected ProductResource              $productResource,
        protected WeightPriceCollectionFactory $weightPriceColFactor,
        array                                  $data = []
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
        $method = $this->rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->_method);
        $method->setMethodTitle($this->getConfigData('name'));

        $shippingCost = $this->calculateShippingCost($request);
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

    /**
     * Calculate shipping cost
     *
     * @param RateRequest $request
     * @return float
     */
    protected function calculateShippingCost(RateRequest $request): float
    {
        $calculationType = $this->getConfigData('price_calculation_type');

        if ($calculationType === PriceCalculationType::WEIGHT) {
            $totalWeight = 0;
            $weightAttr = $this->getConfigData('weight_attribute') ?: 'weight';

            foreach ($request->getAllItems() as $item) {
                if ($item->getProduct()->getTypeId() === 'configurable') {
                    continue;
                }
                $weight = (float)$item->getProduct()->getData($weightAttr);
                $qty = (float)$item->getQty();
                $totalWeight += $weight * $qty;
            }

            $collection = $this->weightPriceColFactor->create();
            $collection->addFieldToFilter('weight_from', ['lte' => $totalWeight])
                ->addFieldToFilter('weight_to', ['gt' => $totalWeight])
                ->setPageSize(1);

            $weightPrice = $collection->getFirstItem();
            if ($weightPrice->getId()) {
                return (float)$weightPrice->getPrice();
            }
        }

        return (float)$this->getConfigData('price');
    }
}
