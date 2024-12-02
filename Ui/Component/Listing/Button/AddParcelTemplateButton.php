<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Ui\Component\Listing\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class AddParcelTemplateButton implements ButtonProviderInterface
{
    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * AddParcelTemplateButton constructor.
     *
     * @param Context $context
     * @param AuthorizationInterface $authorization
     */
    public function __construct(
        private readonly Context       $context,
        private readonly AuthorizationInterface $authorization
    ) {
        $this->urlBuilder = $this->context->getUrlBuilder();
    }

    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->authorization->isAllowed('Smartcore_InPostInternational::parceltemplate_create')) {
            return [];
        }

        return [
            'label' => __('Add Parcel Template'),
            'class' => 'primary',
            'on_click' => sprintf("location.href = '%s';", $this->getAddUrl()),
            'sort_order' => 10,
        ];
    }

    /**
     * Get URL for button
     *
     * @return string
     */
    public function getAddUrl(): string
    {
        return $this->urlBuilder->getUrl('inpostinternational/parceltemplate/create');
    }
}
