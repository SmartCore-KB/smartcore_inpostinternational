<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\DataProvider\Shipment;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Sales\Model\Order;
use Smartcore\InPostInternational\Model\Config\CountrySettings;
use Smartcore\InPostInternational\Model\Config\Source\AutoInsurance;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Order\Processor as OrderProcessor;
use Smartcore\InPostInternational\Model\ParcelTemplateRepository;
use Smartcore\InPostInternational\Model\PickupAddressRepository;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
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
     * @param ParcelTemplateRepository $parcelTmplRepository
     * @param PickupAddressRepository $pickupAddrRepository
     * @param ConfigProvider $configProvider
     * @param SessionManagerInterface $sessionManager
     * @param array $meta
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        string                           $name,
        string                           $primaryFieldName,
        string                           $requestFieldName,
        ReportingInterface               $reporting,
        SearchCriteriaBuilder            $searchCritBuilder,
        RequestInterface                 $request,
        FilterBuilder                    $filterBuilder,
        private readonly OrderProcessor  $orderProcessor,
        private PriceCurrencyInterface   $priceCurrency,
        private CountrySettings          $countrySettings,
        private ParcelTemplateRepository $parcelTmplRepository,
        private PickupAddressRepository  $pickupAddrRepository,
        private ConfigProvider           $configProvider,
        private SessionManagerInterface  $sessionManager,
        array                            $meta = [],
        array                            $data = []
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
        $parcelTmplDefaultId = $this->parcelTmplRepository->getDefaultId();
        $pickupAddrDefaultId = $this->pickupAddrRepository->getDefaultId();

        $defaultData = [
            'shipment_fieldset' => [
                'shipment_type' => $this->configProvider->getShipmentType(),
                'parcel_template' => $parcelTmplDefaultId,
                'origin' => $pickupAddrDefaultId
            ],
        ];

        $sessionData = $this->sessionManager->getFormData(true);

        if ($orderId) {
            $order = $this->orderProcessor->getOrder($orderId);
            if ($order) {
                /** @var Order $order */
                $shippingAddress = $order->getShippingAddress();
                $countryId = $shippingAddress->getCountryId();
                $grandTotal = $this->priceCurrency->convertAndRound($order->getGrandTotal());
                $currencyCode = $order->getOrderCurrencyCode();

                $autoInsuranceSetting = (int)$this->configProvider->getAutoInsuranceSetting();
                $insuranceValue = match ($autoInsuranceSetting) {
                    AutoInsurance::AUTO_INSURANCE_ORDER => $grandTotal,
                    AutoInsurance::AUTO_INSURANCE_FIXED => $this->configProvider->getInsuranceValue(),
                    default => 0,
                };
                $insuranceValue = (float) min($insuranceValue, $this->configProvider->getInsuranceMaxValue());

                $orderData = [
                    'order_id' => $orderId,
                    'order_increment_id' => $order->getIncrementId(),
                    'order_details' => sprintf('%s - %s %s', $order->getIncrementId(), $grandTotal, $currencyCode),
                    'destination_country' => $countryId,
                    'point_name' => $order->getInpostinternationalLockerId(),
                    'first_name' => $order->getCustomerFirstname(),
                    'last_name' => $order->getCustomerLastname(),
                    'company_name' => $shippingAddress->getCompany(),
                    'email' => $order->getCustomerEmail(),
                    'phone_prefix' => $this->countrySettings->getPhonePrefix($countryId),
                    'phone_number' => $this->countrySettings->getPhoneNumberWithoutPrefixForCountry(
                        $shippingAddress->getTelephone(),
                        $countryId
                    ),
                    'language_code' => $this->countrySettings->getLanguageCode($countryId),
                    'insurance_value' => $insuranceValue,
                    'insurance_currency' => $currencyCode,
                ];

                return [
                    $orderId => ['shipment_fieldset' => array_merge(
                        $defaultData['shipment_fieldset'],
                        $orderData,
                        $sessionData['shipment_fieldset'] ?? []
                    )]
                ];
            }
        }

        return [null => array_merge($defaultData, $sessionData ?? [])];
    }
}
