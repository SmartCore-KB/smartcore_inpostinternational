<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipment;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Smartcore\InPostInternational\Exception\LabelException;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;
use Smartcore\InPostInternational\Model\InPostShipmentRepository;
use Smartcore\InPostInternational\Model\ResourceModel\InPostShipment\CollectionFactory as ShipmentCollectionFactory;
use Smartcore\InPostInternational\Service\FileService;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
abstract class MassGetInPostLabels extends Action
{

    /**
     * MassGetInPostShipmentLabels constructor
     *
     * @param Context $context
     * @param Filter $filter
     * @param InPostShipmentRepository $shipmentRepository
     * @param FileFactory $fileFactory
     * @param FileService $fileService
     * @param InternationalApiService $apiService
     * @param CollectionFactory $orderCollFactory
     * @param ShipmentCollectionFactory $shipmentCollFactory
     */
    public function __construct(
        Context                                      $context,
        protected readonly Filter                    $filter,
        protected readonly InPostShipmentRepository  $shipmentRepository,
        protected readonly FileFactory               $fileFactory,
        protected readonly FileService               $fileService,
        protected readonly InternationalApiService   $apiService,
        protected readonly CollectionFactory         $orderCollFactory,
        protected readonly ShipmentCollectionFactory $shipmentCollFactory,
    ) {
        parent::__construct($context);
    }

    /**
     * Get collection of shipments
     *
     * @return iterable
     */
    abstract protected function getCollection(): iterable;

    /**
     * Execute action
     *
     * @return ResponseInterface
     */
    public function execute(): ResponseInterface
    {
        try {
            $collection = $this->getCollection();
            return $this->downloadLabels($collection);
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->_redirect('*/*/index');
        }
    }

    /**
     * Download labels
     *
     * @param iterable $shipments
     * @return ResponseInterface
     * @throws LabelException
     * @throws LocalizedException
     * @throws FileSystemException
     */
    protected function downloadLabels(iterable $shipments): ResponseInterface
    {
        $labels = [];

        foreach ($shipments as $shipment) {
            $labelUrl = $shipment->getLabelUrl();
            if (!$labelUrl) {
                throw new LabelException(
                    __('Label URL not found for shipment %1.', $shipment->getId())->render()
                );
            }

            $content = $this->apiService->getLabel($shipment);
            $fileName = $this->fileService->getLabelFilename($shipment);
            $labels[$fileName] = $content;
        }

        if (empty($labels)) {
            throw new LocalizedException(__('No labels found.'));
        }

        $zipFileName = $this->fileService->createDateTimeFilename('inpostinternational_labels', 'zip');
        $labelsZipPath = $this->fileService->createZip($labels, $zipFileName);

        // @phpstan-ignore-next-line
        return $this->fileFactory->create(
            // @phpstan-ignore argument.type
            $zipFileName,
            ['type' => 'filename', 'value' => $labelsZipPath, 'rm' => true],
            DirectoryList::VAR_DIR,
            'application/pdf'
        );
    }
}
