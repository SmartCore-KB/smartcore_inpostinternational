<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;
use Magento\Sales\Helper\Admin;
use Smartcore\InPostInternational\Api\Data\InPostShipmentInterface;
use Smartcore\InPostInternational\Model\Config\Source\ShippingMethods;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\InPostShipment;

class InPostOrderView extends AbstractOrder
{
    /**
     * @var ShippingMethods
     */
    protected $shippingMethods;

    /**
     * @var \Smartcore\InPostInternational\Model\InPostShipment
     */
    protected $inpostShipment;

    /**
     * @var string //\Smartcore\InPostInternational\Model\ShipmentRepository
     */
    protected $shipmentRepository;

    /**
     * @var \Smartcore\InPostInternational\Model\Config\Source\Size
     */
    protected $sizeConfig;

    /**
     * @var \Smartcore\InPostInternational\Model\Config\Source\Service
     */
    protected $serviceConfig;

    /**
     * @var \Smartcore\InPostInternational\Model\Config\Source\Status
     */
    protected $statusConfig;

    /**
     * @var ConfigProvider
     */
    protected $configProvider;

    /**
     * InpostOrderView constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param Admin $adminHelper
     * @param ShippingMethods $shippingMethods
     * @param ConfigProvider $configProvider
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Admin $adminHelper,
        ShippingMethods $shippingMethods,
        ConfigProvider $configProvider,
        array $data = [],
        //        ?ShippingHelper $shippingHelper = null,
        //        ?TaxHelper $taxHelper = null
    ) {
        $this->shippingMethods = $shippingMethods;
        $this->configProvider = $configProvider;
        parent::__construct($context, $registry, $adminHelper, $data);
    }

    /**
     * Get the list of available Inpost shipping methods
     *
     * @return array
     */
    public function getInpostShippingMethods(): array
    {
        return $this->shippingMethods->toOptionArray(true);
    }

    /**
     * Get the selected shipping method for the order
     *
     * @return string
     */
    public function getSelectedMethod(): string
    {
        try {
            return $this->getOrder()->getShippingMethod();
        } catch (LocalizedException $e) {
            return '';
        }
    }

    /**
     * Get the Inpost shipments associated with the order
     *
     * @return array
     * @throws LocalizedException
     */
    public function getInpostShipments(): array
    {
        $shipments = [];
        return $shipments;
    }

    /**
     * Get the tracking URL for the shipment
     *
     * @param InPostShipment $shipment
     * @return string
     */
    public function getShippingTrackingUrl(InPostShipment $shipment): string
    {
        $tracking = $shipment->getTrackingNumber();
        return 'https://inpost.pl/sledzenie-przesylek?number=' . $tracking;
    }

    /**
     * Get the shipping service label for the shipment
     *
     * @param InPostShipment $shipment
     * @return string
     */
    public function getShippingService(InPostShipment $shipment): string
    {
        return $this->serviceConfig->getServiceLabel($shipment->getShippingMethod())->__toString();
    }

    /**
     * Get shipping details for the shipment
     *
     * @param InPostShipment $shipment
     * @return array
     */
    public function getShippingDetails(InPostShipment $shipment): array
    {
        $details = [];
        $details[InPostShipmentInterface::STATUS] = $this->statusConfig->getStatusLabel($shipment->getStatus());
        if (strpos($shipment->getService(), 'inpost_locker') !== false) {
            $details[InPostShipmentInterface::SHIPMENT_ATTRIBUTES] =
                $this->sizeConfig->getSizeLabel($shipment->getShipmentsAttributes());
            $details[InPostShipmentInterface::TARGET_POINT] = __("Point: ") . $shipment->getTargetPoint();
        }
        return $details;
    }

    /**
     * Get the label URL for the shipment
     *
     * @param InPostShipment $shipment
     * @return string
     */
    public function getLabelUrl(InPostShipment $shipment): string
    {
        return $this->getUrl(
            'inpostinternational/shipments/printLabel',
            ['id' => $shipment->getShipmentId(), 'order_id' => $this->getOrder()->getId()]
        );
    }

    /**
     * Check if return is possible for the shipment
     *
     * @param InPostShipment $shipment
     * @return bool
     */
    public function isReturnPossible(InPostShipment $shipment): bool
    {
        if (in_array($shipment->getService(), ['inpost_courier_c2c', 'inpost_courier_c2ccod'])) {
            return false;
        }
        return true;
    }

    /**
     * Get the return URL for the shipment
     *
     * @param InPostShipment $shipment
     * @return string
     */
    public function getReturnUrl(InPostShipment $shipment): string
    {
        if ($shipment->getService() != 'inpost_locker_standard') {
            return $this->getUrl(
                'inpostinternational/shipments/printReturnLabel',
                ['id' => $shipment->getShipmentId(), 'order_id' => $this->getOrder()->getId()]
            );
        }

        return $this->configProvider->getSzybkiezwrotyUrl();
    }

    /**
     * Check if the URL should be blank
     *
     * @param InPostShipment $shipment
     * @return bool
     */
    public function isUrlBlank(InPostShipment $shipment): bool
    {
        if ($shipment->getService() != 'inpost_locker_standard') {
            return false;
        }

        return true;
    }

    /**
     * Get the Inpost shipment by shipment ID
     *
     * @param string $inpostShipmentId
     * @return mixed|null
     */
    public function getInpostShipment(string $inpostShipmentId)
    {
        $shipment = $inpostShipmentId;
        //        try {
        //                        $shipment =  $this->shipmentRepository->getByShipmentId($inpostShipmentId);
        //        } catch (\Exception $e) {
        //        }
        return $shipment;
    }
}
