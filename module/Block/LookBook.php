<?php

namespace MagentoEse\LookBook\Block;

use Magento\Catalog\Block\Category\View as CategoryView;
use Magento\Catalog\Model\Category;

class LookBook extends CategoryView
{
    public function _construct()
    {
        if (!$this->hasTemplate()) {
            $this->setTemplate('MagentoEse_LookBook::lookbook.phtml');
        }
    }

    public function getLookUrl(Category $category)
    {
        return $this->getUrl('lookbook/look/view', ['id' => $category->getId()]);
    }
}
