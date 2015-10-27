<?php

namespace MagentoEse\LookBook\Block\LookBook;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\Product;

class View extends ListProduct
{
    public function getDefaultDetailUrl()
    {
        return $this->getDetailUrl($this->getLoadedProductCollection()->getFirstItem());
    }

    public function getDetailUrl(Product $product)
    {
        return $this->getUrl('lookbook/look/item', ['id' => $product->getId()]);
    }
}
