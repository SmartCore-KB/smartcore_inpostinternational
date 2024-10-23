<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Button;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;

class AuthRequestButton extends Field
{
    /**
     * @var string
     */
    protected $_template = 'Smartcore_InPostInternational::system/config/button.phtml';
    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * AuthRequestButton constructor.
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array   $data = []
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        parent::__construct($context, $data);
    }

    /**
     * Generate button html
     *
     * @return string
     * @throws LocalizedException
     */
    public function getButtonHtml()
    {
        $buttonData = [
            'id' => 'auth_request',
            'label' => __('Request Authorization'),
            'onclick' => 'window.open(\'' . $this->getButtonUrl() . '\', \'_blank\')'
        ];

        return $this->getLayout()->createBlock(Button::class)
            ->setData($buttonData)
            ->toHtml();
    }

    /**
     * Get url for button
     *
     * @return string
     */
    public function getButtonUrl(): string
    {
        return $this->urlBuilder->getUrl('inpostinternational/system_config/requestauthorization');
    }

    /**
     * Render element
     *
     * @param AbstractElement $element
     * @return string
     * @SuppressWarnings("unused")
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        return $this->_toHtml();
    }
}
