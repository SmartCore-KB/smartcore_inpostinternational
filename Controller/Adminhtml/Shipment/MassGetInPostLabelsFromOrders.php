<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipment;

use Magento\Framework\Exception\LocalizedException;

class MassGetInPostLabelsFromOrders extends MassGetInPostLabels
{
    /**
     * Get collection of shipments
     *
     * @return iterable
     * @throws LocalizedException
     */
    protected function getCollection(): iterable
    {
        $orderIds = $this->filter->getCollection($this->orderCollFactory->create())->getAllIds();
        $shipments = [];

        foreach ($orderIds as $orderId) {
            $foundShipments = $this->shipmentRepository->getListByOrderId((string) $orderId);
            if (count($foundShipments) > 0) {
                foreach ($foundShipments as $foundShipment) {
                    $shipments[] = $foundShipment;
                }
            }
        }

        return $shipments;
    }

    /**
     * Check permission for action
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::shipments_index');
    }
}
