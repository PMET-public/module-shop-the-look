<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\LookBook\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * EAV setup factory
     *
     * @var eavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $entityTypeId = $eavSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
        $attributeSetId = $eavSetup->getAttributeSetId($entityTypeId, 'Default');

        $eavSetup->addAttributeGroup($entityTypeId, $attributeSetId, 'Look Book', 8);

        /**
         * Add attributes to the eav/attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'look_book_headline',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Headline',
                'input' => 'text',
                'required' => false,
                'sort_order' => 30,
                'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                'group' => 'Product Details',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'look_book_subtitle',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Subtitle',
                'input' => 'text',
                'required' => false,
                'sort_order' => 35,
                'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                'group' => 'Product Details',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'look_book_image',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Image',
                'input' => 'text',
                'required' => false,
                'sort_order' => 40,
                'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                'group' => 'Product Details',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'look_book_main_image',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Image',
                'input' => 'text',
                'required' => false,
                'sort_order' => 20,
                'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                'group' => 'General Information'
            ]
        );
    }
}
