<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Catalog\Controller\Category\View as CategoryView;
use Magento\Framework\Controller\ResultFactory;

class View extends CategoryView
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        $category = $this->_initCategory();
        if ($category) {
            $page = $this->resultPageFactory->create();
            $result->setContents($page->getLayout()->renderElement('lookbook.view'));
        } else {
            $result->setHttpResponseCode(404);
        }

        return $result;
    }
}
