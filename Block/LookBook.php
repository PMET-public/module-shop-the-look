<?php

namespace MagentoEse\LookBook\Block;

use Magento\Framework\View\Element\Template;

class LookBook extends Template
{
    public function getLookBookJson()
    {
        return json_encode([]);
    }
}
