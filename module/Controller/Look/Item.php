<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Catalog\Controller\Product\View;
use Magento\Framework\Controller\ResultFactory;

class Item extends View
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $data = [];

        $product = $this->_initProduct();
        if ($product) {
            $page = $this->resultPageFactory->create();
            $data['html'] = $page->getLayout()->renderElement('lookbook.product.info');
        } else {
            $result->setHttpResponseCode(404);
            $data['error'] = 1;
        }
        $result->setData($data);
        return $result;
    }
}
