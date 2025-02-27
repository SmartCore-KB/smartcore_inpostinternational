<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;
use Magento\Sales\Helper\Admin;
use Smartcore\InPostInternational\Model\Config\Source\ShippingMethods;
use Smartcore\InPostInternational\Model\InPostShipment;
use Smartcore\InPostInternational\Model\InPostShipmentRepository;

class InPostInternationalOrderView extends AbstractOrder
{

    /**
     * InpostOrderView constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param Admin $adminHelper
     * @param ShippingMethods $shippingMethods
     * @param InPostShipmentRepository $shipmentRepository
     * @param array $data
     */
    public function __construct(
        Context                                   $context,
        Registry                                  $registry,
        Admin                                     $adminHelper,
        private readonly ShippingMethods          $shippingMethods,
        private readonly InPostShipmentRepository $shipmentRepository,
        array                                     $data = [],
    ) {
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
     * @return array<InPostShipment>
     */
    public function getInpostShipments(): array
    {
        try {
            $order = $this->getOrder();
            return $this->shipmentRepository->getListByOrderId((string) $order->getId());
        } catch (LocalizedException $exception) {
            return [];
        }
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
     * Get the label URL for the shipment
     *
     * @param InPostShipment $shipment
     * @return string
     */
    public function getLabelUrl(InPostShipment $shipment): string
    {
        return $this->getUrl(
            'inpostinternational/shipment/label',
            ['id' => $shipment->getId()]
        );
    }

    /**
     * Get the Inpost locker ID for the order
     *
     * @return mixed
     * @throws LocalizedException
     */
    public function getSelectedLockerId()
    {
        return $this->getOrder()->getInpostinternationalLockerId();
    }
}
