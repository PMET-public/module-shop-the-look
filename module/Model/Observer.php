<?php

namespace MagentoEse\LookBook\Model;

use Magento\Framework\Event\Observer as EventObserver;

class Observer
{
    /**
     * @param EventObserver $event
     */
    public function loadLayoutBefore(EventObserver $event)
    {
        /** @var \Magento\Framework\View\LayoutInterface $layout */
        $layout = $event->getLayout();
        $layout->getUpdate()->addHandle('lookbook_look_index');
    }
}
