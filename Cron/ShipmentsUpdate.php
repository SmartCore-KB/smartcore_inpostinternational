<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Cron;

use DateInterval;
use DateInvalidOperationException;
use DateTime;
use Exception;
use Psr\Log\LoggerInterface;
use Smartcore\InPostInternational\Model\InPostShipmentRepository;
use Smartcore\InPostInternational\Service\ShipmentProcessor;

class ShipmentsUpdate
{

    /**
     * ShipmentsUpdate constructor.
     *
     * @param InPostShipmentRepository $shipmentRepository
     * @param ShipmentProcessor $shipmentProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly InPostShipmentRepository $shipmentRepository,
        private readonly ShipmentProcessor        $shipmentProcessor,
        private readonly LoggerInterface          $logger
    ) {
    }

    /**
     * Execute action
     *
     * @throws DateInvalidOperationException
     */
    public function execute(): void
    {
        $date = new DateTime();
        $date->sub(new DateInterval('P1M'));
        $updatedSince = $date->format('Y-m-d H:i:s');

        $shipments = $this->shipmentRepository->getList($updatedSince);

        foreach ($shipments as $shipment) {
            try {
                $this->shipmentProcessor->updateInPostShipmentFromApi($shipment);
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
