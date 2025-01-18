<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Cron;

use DateInterval;
use DateTime;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\InPostShipmentRepository;
use Smartcore\InPostInternational\Service\ShipmentProcessor;

class ShipmentsUpdate
{

    /**
     * ShipmentsUpdate constructor.
     *
     * @param InPostShipmentRepository $shipmentRepository
     * @param ShipmentProcessor $shipmentProcessor
     */
    public function __construct(
        private readonly InPostShipmentRepository $shipmentRepository,
        private readonly ShipmentProcessor        $shipmentProcessor
    ) {
    }

    /**
     * Execute action
     *
     * @throws \DateInvalidOperationException
     * @throws AlreadyExistsException
     * @throws LocalizedException
     * @throws TokenSaveException
     */
    public function execute()
    {
        $date = new DateTime();
        $date->sub(new DateInterval('P1M'));
        $updatedSince = $date->format('Y-m-d H:i:s');

        $shipments = $this->shipmentRepository->getList($updatedSince);

        foreach ($shipments as $shipment) {
            $this->shipmentProcessor->updateInPostShipmentFromApi($shipment);
        }
    }
}
