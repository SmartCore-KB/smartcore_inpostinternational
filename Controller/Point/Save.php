<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Point;

use Exception;
use InvalidArgumentException;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Api\CartRepositoryInterface;
use RuntimeException;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @param Context $context
     * @param CartRepositoryInterface $quoteRepository
     * @param JsonFactory $jsonFactory
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        Context $context,
        private readonly CartRepositoryInterface $quoteRepository,
        private readonly JsonFactory $jsonFactory,
        private readonly CheckoutSession $checkoutSession
    ) {
        parent::__construct($context);
    }

    /**
     * Save selected InPost point to quote
     *
     * @return Json
     */
    public function execute(): Json
    {
        $result = $this->jsonFactory->create();

        try {
            $pointId = $this->getRequest()->getParam('point_id');
            if (!$pointId) {
                throw new InvalidArgumentException('Point ID is required');
            }

            $quote = $this->checkoutSession->getQuote();
            if (!$quote->getId()) {
                throw new RuntimeException('Active quote not found');
            }

            $quote->setInpostinternationalLockerId($pointId);

            $pointData = $this->getRequest()->getParam('point_data');
            if ($pointData) {
                $quote->setInpostinternationalLockerData($pointData);
            }

            $this->quoteRepository->save($quote);

            return $result->setData([
                'success' => true
            ]);
        } catch (Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
