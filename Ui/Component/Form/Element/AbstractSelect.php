<?php

namespace Smartcore\InPostInternational\Ui\Component\Form\Element;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Message\Manager;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\Element\Select;
use Smartcore\InPostInternational\Model\Config\Source\DefaultWaySending;
use Smartcore\InPostInternational\Model\Config\Source\Size as SizeSource;
use Smartcore\InPostInternational\Model\ConfigProvider;

abstract class AbstractSelect extends Select
{
    /**
     * @var Http
     */
    protected $request;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @var DefaultWaySending
     */
    protected $defaultWaySending;

    /**
     * @var ConfigProvider
     */
    protected $configProvider;

    /**
     * @var Manager
     */
    protected $messageManager;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var SizeSource
     */
    protected $size;

    /**
     * SendingMethod constructor.
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @param Http $request
     * @param PriceCurrencyInterface $priceCurrency
     * @param ContextInterface $context
     * @param DefaultWaySending $defaultWaySending
     * @param ConfigProvider $configProvider
     * @param Manager $messageManager
     * @param UrlInterface $urlBuilder
     * @param SizeSource $size
     * @param array|OptionSourceInterface|null $options
     * @param array $components
     * @param array $data
     */
    public function __construct(
        Http                        $request,
        PriceCurrencyInterface      $priceCurrency,
        ContextInterface            $context,
        DefaultWaySending           $defaultWaySending,
        ConfigProvider              $configProvider,
        Manager                     $messageManager,
        UrlInterface                $urlBuilder,
        SizeSource                  $size,
        array|OptionSourceInterface $options = null,
        array                       $components = [],
        array                       $data = []
    ) {
        parent::__construct($context, $options, $components, $data);
        $this->request = $request;
        $this->priceCurrency = $priceCurrency;
        $this->defaultWaySending = $defaultWaySending;
        $this->configProvider = $configProvider;
        $this->messageManager = $messageManager;
        $this->urlBuilder = $urlBuilder;
        $this->size = $size;
    }
}
