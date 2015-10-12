<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Catalog\Controller\Product\View;
use Magento\Framework\Controller\ResultFactory;

class Item extends View
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        $category = $this->_initCategory();
        if ($category) {
            $page = $this->resultPageFactory->create();
            $result->setContents($page->getLayout()->renderElement('lookbook.product.info'));
        } else {
            $result->setHttpResponseCode(404);
        }

        return $result;
    }
}
