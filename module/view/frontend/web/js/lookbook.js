define([
    'jquery',
    'mage/translate',
    '!domReady'
], function ($) {
    'use strict';

    $.widget('MagentoEse_LookBook.popup', {
        options: {
            type: 'popup',
            title: $.mage.__('Shop this Look'),
            modalClass: 'lookbook-popup',
            responsive: true,
            innerScroll: true,
            buttons: []
        }
    });

    return $.MagentoEse_LookBook.popup;
});
