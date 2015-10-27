<?php

namespace MagentoEse\LookBook\Plugin;

use Magento\Framework\View\Result\Page as Page;

class Layout
{
    public function beforeAddUpdate(Page $page, $update)
    {
        if (stripos($update, '<update handle="lookbook_look_index"/>') !== false) {
            $page->getLayout()->getUpdate()->addHandle('lookbook_look_index');
        }
        return [$update];
    }
}
