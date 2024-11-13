<?php
namespace Smartcore\InPostInternational\Block\Adminhtml\Shipment\Create;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Request\Http;
use Magento\Sales\Api\OrderRepositoryInterface;

class StreetInfo extends Template
{
    /**
     * @var Http
     */
    protected $request;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * Block template
     *
     * @var string
     */
    protected $_template = 'Smartcore_InPostInternational::shipment/create/street_info.phtml';

    /**
     * StreetInfo constructor.
     *
     * @param Http $request
     * @param OrderRepositoryInterface $orderRepository
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Http $request,
        OrderRepositoryInterface $orderRepository,
        Context $context,
        array $data = []
    ) {
        $this->request = $request;
        $this->orderRepository = $orderRepository;

        $params = $this->request->getParams();

        if (strpos($params['shipping_method'], 'inpostlocker') !== false) {
            $this->_template = '';
        }
        parent::__construct($context, $data);
    }
}
