<?php

namespace MagentoEse\LookBook\Block;

use Magento\Catalog\Block\Category\View;

class LookBook extends View
{
    public function _construct()
    {
        if (!$this->hasTemplate()) {
            $this->setTemplate('MagentoEse_LookBook::lookbook.phtml');
        }
    }

    public function getLookBookJson()
    {
        return json_encode([]);
    }
}
