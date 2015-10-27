<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Catalog\Controller\Product\View as ProductView;
use Magento\Framework\Controller\ResultFactory;

class Item extends ProductView
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        $product = $this->_initProduct();
        if ($product) {
            $productTypeId = $product->getTypeId();

            $page = $this->resultPageFactory->create();
            $page->addHandle('catalog_product_view_type_'.$productTypeId);
            $result->setContents($page->getLayout()->renderElement('lookbook.product.info'));
        } else {
            $result->setHttpResponseCode(404);
        }

        return $result;
    }
}
