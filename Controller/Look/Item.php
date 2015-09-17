<?php

namespace MagentoEse\LookBook\Controller\Look;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Item extends Action
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result->setData([]);

        return $result;
    }
}
