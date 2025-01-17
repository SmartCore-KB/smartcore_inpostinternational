<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Smartcore\InPostInternational\Model\Shipment;
use ZipArchive;

class FileService
{

    /**
     * MassGetInPostShipmentLabels constructor
     *
     * @param DirectoryList $directoryList
     * @param DateTime $dateTime
     * @param OrderRepository $orderRepository
     * @param PsrLoggerInterface $logger
     */
    public function __construct(
        private readonly DirectoryList           $directoryList,
        private readonly DateTime                $dateTime,
        private readonly OrderRepository         $orderRepository,
        private readonly PsrLoggerInterface      $logger,
    ) {
    }

    /**
     * Create a ZIP file with labels
     *
     * @param array<string> $files
     * @param string $zipFileName
     * @return string
     * @throws FileSystemException
     * @throws LocalizedException
     */
    public function createZip(array $files, string $zipFileName): string
    {
        $zip = new ZipArchive();
        $zipFilePath = $this->directoryList->getPath(DirectoryList::VAR_DIR) . '/' . $zipFileName;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
            throw new LocalizedException(__('Cannot create a ZIP file.'));
        }

        foreach ($files as $labelFileName => $fileContent) {
            $zip->addFromString($labelFileName, $fileContent);
        }
        $zip->close();

        return $zipFilePath;
    }

    /**
     * Create a filename with a current date and time
     *
     * @param string $prefix
     * @param string $extension
     * @return string
     */
    public function createDateTimeFilename(string $prefix, string $extension): string
    {
        return sprintf($prefix . '-%s.' . $extension, $this->dateTime->date('Y-m-d_H-i-s'));
    }

    /**
     * Get a label filename
     *
     * @param Shipment $shipment
     * @return string
     */
    public function getLabelFilename(Shipment $shipment): string
    {
        $incrementId = '';
        if ($shipment->getOrderId()) {
            try {
                $order = $this->orderRepository->get($shipment->getOrderId());
                $incrementId = $order->getId() ? $order->getIncrementId() : '';
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
        return sprintf('label-%s-%s.pdf', $incrementId, $shipment->getId());
    }
}
