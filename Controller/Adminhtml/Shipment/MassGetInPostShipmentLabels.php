<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipment;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Smartcore\InPostInternational\Exception\LabelException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;
use Smartcore\InPostInternational\Model\Shipment;
use Smartcore\InPostInternational\Model\ShipmentRepository;
use Smartcore\InPostInternational\Service\FileService;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MassGetInPostShipmentLabels extends Action
{

    /**
     * MassGetInPostShipmentLabels constructor
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param InternationalApiService $apiService
     * @param ShipmentRepository $shipmentRepository
     * @param FileFactory $fileFactory
     * @param FileService $fileService
     */
    public function __construct(
        Context                                  $context,
        private readonly Filter                  $filter,
        private readonly CollectionFactory       $collectionFactory,
        private readonly InternationalApiService $apiService,
        private readonly ShipmentRepository      $shipmentRepository,
        private readonly FileFactory             $fileFactory,
        private readonly FileService             $fileService
    ) {
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @throws TokenSaveException
     * @throws LocalizedException
     * @throws Exception
     */
    public function execute(): ResponseInterface
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $labels = [];

        foreach ($collection as $order) {
            try {
                /** @var Shipment $shipment */
                $shipments = $this->shipmentRepository->getListByOrderId((string) $order->getId());
                foreach ($shipments as $shipment) {
                    $labelUrl = $shipment->getLabelUrl();

                    if (!$labelUrl) {
                        throw new LabelException(
                            sprintf(
                                __('Label URL not found for shipment %s from order %s.')->render(),
                                $shipment->getId(),
                                $order->getIncrementId()
                            )
                        );
                    }

                    try {
                        $content = $this->apiService->getLabel($shipment);
                    } catch (Exception $e) {
                        throw new LabelException(
                            sprintf(__('Unable to download the label: %s')->render(), $e->getMessage())
                        );
                    }

                    $labels[sprintf('label-%s-%s.pdf', $order->getIncrementId(), $shipment->getId())] = $content;
                }
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->_redirect('*/*/index');
            }
        }

        if (empty($labels)) {
            $this->messageManager->addErrorMessage(__('No labels found.')->render());
            return $this->_redirect('*/*/index');
        }

        $zipFileName = $this->fileService->createDateTimeFilename('inpostinternational_labels', 'zip');
        $labelsZipPath = $this->fileService->createZip($labels, $zipFileName);

        // @phpstan-ignore-next-line
        return $this->fileFactory->create(
            // @phpstan-ignore argument.type
            $zipFileName,
            [
                'type' => 'filename',
                'value' => $labelsZipPath,
                'rm' => true,
            ],
            DirectoryList::VAR_DIR,
            'application/pdf'
        );
    }

    /**
     * Check if user has permissions to visit the controller
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::shipments_index');
    }
}
