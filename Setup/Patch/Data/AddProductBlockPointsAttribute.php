<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Validator\ValidateException;
use Psr\Log\LoggerInterface;

/**
 * Class AddProductBlockAttribute which adds an attribute block_inpostinternational_points to the product
 */
class AddProductBlockPointsAttribute implements DataPatchInterface, PatchRevertableInterface
{
    public const BLOCK_INPOSTINTERNATIONAL_POINTS = 'block_inpostinternational_points';

    /**
     * @var ModuleDataSetupInterface
     */
    protected ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    protected EavSetupFactory $eavSetupFactory;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * AddProductSendLockerAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function apply(): self
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        try {
            $eavSetup->addAttribute(
                Product::ENTITY,
                self::BLOCK_INPOSTINTERNATIONAL_POINTS,
                [
                    'type' => 'int',
                    'label' => 'Block send to InPost International Points',
                    'input' => 'boolean',
                    'user_defined' => false,
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'General',
                    'source' => Boolean::class,
                    'default' => 0,
                    'sort_order' => 33766,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                ]
            );
        } catch (LocalizedException $e) {
            $this->logger->error('LocalizedException: ' . $e->getMessage());
        } catch (ValidateException $e) {
            $this->logger->error('ValidateException: ' . $e->getMessage());
        }

        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function revert(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(
            Product::ENTITY,
            self::BLOCK_INPOSTINTERNATIONAL_POINTS
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
