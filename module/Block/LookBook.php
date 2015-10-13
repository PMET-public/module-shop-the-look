<?php

namespace MagentoEse\LookBook\Block;

use Magento\Catalog\Block\Category\View as CategoryView;
use Magento\Catalog\Model\Category;
use Magento\Framework\DB\Select;

class LookBook extends CategoryView
{
    public function _construct()
    {
        if (!$this->hasTemplate()) {
            $this->setTemplate('MagentoEse_LookBook::lookbook.phtml');
        }
    }

    /**
     * Returns collection of children categories used to display looks
     *
     * @return \Magento\Catalog\Model\Resource\Category\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getLookCollection()
    {
        $category = $this->getCurrentCategory();

        /* @var $collection \Magento\Catalog\Model\Resource\Category\Collection */
        $collection = $category->getCollection();
        $collection->addAttributeToSelect('url_key')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('description')
            ->addAttributeToSelect('look_book_main_image')
            ->addAttributeToSelect('all_children')
            ->addAttributeToSelect('is_anchor')
            ->addAttributeToFilter('is_active', 1)
            ->addIdFilter($category->getChildren())
            ->setOrder('position', Select::SQL_ASC)
            ->joinUrlRewrite();

        return $collection;
    }

    public function getLookUrl(Category $category)
    {
        return $this->getUrl('lookbook/look/view', ['id' => $category->getId()]);
    }
}
