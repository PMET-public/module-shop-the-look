<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\LookBook\Setup;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
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

        /**
         * Add attributes to the eav/attribute
         */
        $eavSetup->addAttribute(
            Product::ENTITY,
            'look_book_headline',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Headline',
                'input' => 'text',
                'required' => false,
                'sort_order' => 30,
                'global' => Attribute::SCOPE_STORE,
                'group' => 'Product Details',
            ]
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            'look_book_subtitle',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Subtitle',
                'input' => 'text',
                'required' => false,
                'sort_order' => 35,
                'global' => Attribute::SCOPE_STORE,
                'group' => 'Product Details',
            ]
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            'look_book_image',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Image',
                'input' => 'text',
                'required' => false,
                'sort_order' => 40,
                'global' => Attribute::SCOPE_STORE,
                'group' => 'Product Details',
            ]
        );

        $eavSetup->addAttribute(
            Category::ENTITY,
            'look_book_main_image',
            [
                'type' => 'varchar',
                'label' => 'Shop the Look Image',
                'input' => 'text',
                'required' => false,
                'sort_order' => 20,
                'global' => Attribute::SCOPE_STORE,
                'group' => 'General Information'
            ]
        );
    }
}
