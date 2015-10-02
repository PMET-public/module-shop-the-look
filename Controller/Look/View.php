<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Catalog\Controller\Category\View
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $data = [];

        $category = $this->_initCategory();
        if ($category) {
            $page = $this->resultPageFactory->create();
            $data['html'] = $page->getLayout()->renderElement('lookbook.product.list');
        } else {
            $result->setHttpResponseCode(404);
            $data['error'] = 1;
        }
        $result->setData($data);

        return $result;
    }
}
