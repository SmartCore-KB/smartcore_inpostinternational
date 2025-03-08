<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Controller\Adminhtml\Pickup;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Smartcore\InPostInternational\Api\PickupAddressRepositoryInterface;
use Smartcore\InPostInternational\Model\Api\InternationalApiService;

class Cutofftime extends Action
{
    /**
     * @var InternationalApiService
     */
    private InternationalApiService $apiService;

    /**
     * @var PickupAddressRepositoryInterface
     */
    private PickupAddressRepositoryInterface $pickupAddrRepository;

    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;

    /**
     * Cutofftime constructor
     *
     * @param Context $context
     * @param InternationalApiService $apiService
     * @param PickupAddressRepositoryInterface $pickupAddrRepository
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context                          $context,
        InternationalApiService          $apiService,
        PickupAddressRepositoryInterface $pickupAddrRepository,
        JsonFactory                      $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->apiService = $apiService;
        $this->pickupAddrRepository = $pickupAddrRepository;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * Execute the action and return JSON response
     *
     * @return Json
     */
    public function execute(): Json
    {
        $resultJson = $this->resultJsonFactory->create();
        $addressId = $this->getRequest()->getParam('addressId');

        if (!$addressId) {
            return $resultJson->setData([
                'success' => false,
                'info' => 'Error: No address ID provided'
            ]);
        }

        try {
            $pickupAddress = $this->pickupAddrRepository->load((int) $addressId);
            $postalCode = $pickupAddress->getAddressPostalCode();
            $countryCode = $pickupAddress->getAddressCountryCode();

            $cutoffTime = $this->apiService->getCutoffTime($postalCode, $countryCode);

            return $resultJson->setData([
                'success' => true,
                'info' => __(
                    'Pickup for postal code %1 possible until: %2',
                    $cutoffTime['postalCode'],
                    $cutoffTime['cutoffTime']
                )->render()
            ]);
        } catch (\Exception $e) {
            return $resultJson->setData([
                'success' => false,
                'info' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Check if the action is allowed
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Smartcore_InPostInternational::pickup_cutofftime');
    }
}
