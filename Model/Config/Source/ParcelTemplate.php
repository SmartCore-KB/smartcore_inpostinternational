<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Shipping\Model\Config;
use Smartcore\InPostInternational\Api\ParcelTemplateRepositoryInterface;
use Smartcore\InPostInternational\Model\ParcelTemplate as ParcelTemplateModel;

class ParcelTemplate implements OptionSourceInterface
{
    /**
     * Shipping methods mapper
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param Config $shippingConfig
     * @param ParcelTemplateRepositoryInterface $parcelTmplRepository
     */
    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
        protected Config $shippingConfig,
        protected ParcelTemplateRepositoryInterface $parcelTmplRepository
    ) {
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $methods = [];
        $templates = $this->parcelTmplRepository->getList();
        $defaultSet = false;

        /** @var ParcelTemplateModel $template */
        foreach ($templates as $template) {
            $sizeUnit = $template->getDimensionUnit();
            $option = [
                'value' => $template->getId(),
                'label' => sprintf(
                    '%s (%s%s x %s%s x %s%s, %s%s)',
                    $template->getLabel(),
                    $template->getLength(),
                    $sizeUnit,
                    $template->getWidth(),
                    $sizeUnit,
                    $template->getHeight(),
                    $sizeUnit,
                    $template->getWeight(),
                    $template->getWeightUnit()
                ),
            ];

            if (!$defaultSet && $template->isDefault()) {
                $option['selected'] = 'selected';
                $defaultSet = true;
            }

            $methods[] = $option;
        }

        return $methods;
    }
}
