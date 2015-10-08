<?php

namespace MagentoEse\LookBook\Model;

class Observer
{
    protected $_verpageData;
    protected $_registry = null;

    public function __construct (
        \Magento\Framework\Registry $registry
    ) {
        $this->_registry = $registry;
    }

    public function invoke(\Magento\Framework\Event\Observer $observer)
    {
        //die('works');
    }
}