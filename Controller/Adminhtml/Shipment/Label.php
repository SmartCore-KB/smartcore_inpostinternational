<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Shipment;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Smartcore\InPostInternational\Exception\LabelException;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;
use Smartcore\InPostInternational\Model\ShipmentRepository;

class Label extends Action
{

    /**
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * @var ShipmentRepository
     */
    protected $shipmentRepository;

    /**
     * Label constructor.
     *
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param ShipmentRepository $shipmentRepository
     * @param InternationalApiService $apiService
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        ShipmentRepository $shipmentRepository,
        private readonly InternationalApiService  $apiService,
    ) {
        parent::__construct($context);
        $this->fileFactory = $fileFactory;
        $this->shipmentRepository = $shipmentRepository;
    }

    /**
     * Execute action
     *
     * @return ResponseInterface
     */
    public function execute(): ResponseInterface
    {
        $shipmentId = $this->getRequest()->getParam('id');

        try {
            $shipment = $this->shipmentRepository->load((int) $shipmentId);
            $labelUrl = $shipment->getLabelUrl();

            if (!$labelUrl) {
                throw new LabelException(__('Label URL not found for this shipment.')->render());
            }

            try {
                $content = $this->apiService->getLabel($shipment);
            } catch (Exception $e) {
                throw new LabelException(
                    sprintf(__('Unable to download the label: %s')->render(), $e->getMessage())
                );
            }

            $fileName = 'label_' . $shipmentId . '.pdf';

            // @phpstan-ignore-next-line
            return $this->fileFactory->create(
                // @phpstan-ignore argument.type
                $fileName,
                $content,
                DirectoryList::VAR_DIR,
                'application/pdf'
            );
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->_redirect('*/*/index');
        }
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
