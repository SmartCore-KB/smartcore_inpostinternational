<?php

namespace Smartcore\InPostInternational\Ui\DataProvider\Shipment;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Sales\Model\Order;
use Smartcore\InPostInternational\Model\Config\CountrySettings;
use Smartcore\InPostInternational\Model\Order\Processor as OrderProcessor;

class CreateDataProvider extends DataProvider
{

    /**
     * @var Order|null
     */
    protected ?Order $order;

    /**
     * CreateDataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCritBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param OrderProcessor $orderProcessor
     * @param PriceCurrencyInterface $priceCurrency
     * @param CountrySettings $countrySettings
     * @param array $meta
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        string                          $name,
        string                          $primaryFieldName,
        string                          $requestFieldName,
        ReportingInterface              $reporting,
        SearchCriteriaBuilder           $searchCritBuilder,
        RequestInterface                $request,
        FilterBuilder                   $filterBuilder,
        private readonly OrderProcessor $orderProcessor,
        private PriceCurrencyInterface  $priceCurrency,
        private CountrySettings         $countrySettings,
        array                           $meta = [],
        array                           $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCritBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        $orderId = $this->request->getParam('order_id');
        if ($orderId) {
            $order = $this->orderProcessor->getOrder($orderId);
            if ($order) {
                /** @var Order $order */
                $countryId = $order->getShippingAddress()->getCountryId();
                $grandTotal = $this->priceCurrency->convertAndRound($order->getGrandTotal());
                $currencyCode = $order->getOrderCurrencyCode();
                return [
                    $order->getId() => [
                        'shipment_fieldset' => [
                            'order_id' => $order->getId(),
                            'order_details' => $order->getIncrementId() . ' - ' . $grandTotal . ' ' . $currencyCode,
                            'destination_country' => $countryId,
                            'first_name' => $order->getCustomerFirstname(),
                            'last_name' => $order->getCustomerLastname(),
                            'company_name' => $order->getShippingAddress()->getCompany(),
                            'email' => $order->getCustomerEmail(),
                            'phone_prefix' => $this->countrySettings->getPhonePrefix(
                                $countryId
                            ),
                            'phone_number' => $this->countrySettings->getPhoneNumberWithoutPrefixForCountry(
                                $order->getShippingAddress()->getTelephone(),
                                $countryId
                            ),
                            'language_code' => $this->countrySettings->getLanguageCode(
                                $countryId
                            ),
                            'insurance_value' => $grandTotal,
                            'insurance_currency' => $currencyCode,
                        ]
                    ]
                ];
            }
        }
        return [];
    }
}
