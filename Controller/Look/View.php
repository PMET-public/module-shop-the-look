<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Catalog\Controller\Category\View
{
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $data = [];

        $category = $this->_initCategory();
        if ($category) {
            $page = $this->resultPageFactory->create();
            $data['html'] = $page->getLayout()->getBlock('look.view')->toHtml();
        } else {
            $result->setHttpResponseCode(404);
            $data['error'] = 1;
        }
        $result->setData($data);

        return $result;
    }
}
