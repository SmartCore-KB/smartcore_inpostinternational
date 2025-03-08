<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\WeightPrice;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Smartcore\InPostInternational\Model\WeightPriceFactory;
use Smartcore\InPostInternational\Model\WeightPriceRepository;
use Smartcore\InPostInternational\Service\WeightPriceService;

class Save extends Action
{

    /**
     * Save constructor
     *
     * @param Context $context
     * @param WeightPriceRepository $weightPriceRepo
     * @param WeightPriceService $weightPriceService
     * @param WeightPriceFactory $weightPriceFactory
     */
    public function __construct(
        Context                       $context,
        private readonly WeightPriceRepository $weightPriceRepo,
        private readonly WeightPriceService $weightPriceService,
        private readonly WeightPriceFactory $weightPriceFactory,
    ) {
        parent::__construct($context);
    }

    /**
     * Save Weight-based price
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute(): ResultInterface|ResponseInterface|Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue('weightprice_fieldset');

        try {
            if ($data) {
                $weightPrice = $this->weightPriceFactory->create();
                $entityId = $data['entity_id'] ? (int) $data['entity_id'] : null;
                if (isset($data['entity_id'])) {
                    $weightPrice = $this->weightPriceRepo->load((int) $data['entity_id']);
                }

                $weightFrom = (float)$data['weight_from'];
                $weightTo = $data['weight_to'] ? (float)$data['weight_to'] : null;
                $price = (float)$data['price'];

                $this->weightPriceService->validateWeightRanges(
                    $weightFrom,
                    $weightTo,
                    (int) $weightPrice->getId()
                );

                $weightPrice->setWeightFrom($weightFrom);
                $weightPrice->setWeightTo($weightTo);
                $weightPrice->setPrice($price);

                try {
                    $this->weightPriceRepo->save($weightPrice);
                    $this->messageManager->addSuccessMessage(__('Weight-based price has been saved.')->render());
                    return $resultRedirect->setPath('*/*/');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $entityId]);
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving weight-based price. %1', $e->getMessage())->render()
            );
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check if user has permissions to visit the controller
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::weightprice_create');
    }
}
