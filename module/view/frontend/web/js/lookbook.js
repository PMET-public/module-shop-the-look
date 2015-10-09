define([
    'jquery',
    'mage/translate'
], function ($){
    'use strict';

    $.widget('MagentoEse_LookBook.popup', {
        options: {
            type: 'popup',
            title: $.mage.__('Shop this Look'),
            modalClass: 'lookbook-popup',
            responsive: true,
            innerScroll: true,
            buttons: []
        },

        /**
         * Create MagentoEse_LookBook.popup widget
         * @private
         */
        _create: function () {
            $(this.element); // wrap this.element

            //modal(this.options, this.element);
            //this.popup.showPopup();
        }
    });

    return $.MagentoEse_LookBook.popup;
});
