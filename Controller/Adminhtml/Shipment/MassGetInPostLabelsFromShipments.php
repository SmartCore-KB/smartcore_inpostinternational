<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipment;

use Magento\Framework\Exception\LocalizedException;

class MassGetInPostLabelsFromShipments extends MassGetInPostLabels
{
    /**
     * Get collection of shipments
     *
     * @return iterable
     * @throws LocalizedException
     */
    protected function getCollection(): iterable
    {
        $shipmentIds = $this->filter->getCollection($this->shipmentCollFactory->create())->getAllIds();

        return array_map(
            fn ($shipmentId) => $this->shipmentRepository->load((int) $shipmentId),
            $shipmentIds
        );
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
