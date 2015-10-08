define([
    'jquery',
    'mage/translate'
], function ($){
    'use strict';

    $.widget('lookbook.popup', {
        options: {
            type: 'popup',
            title: $.mage.__('Shop this Look'),
            modalClass: 'lookbook-popup',
            responsive: true,
            innerScroll: true,
            buttons: []
        },

        /**
         * Create MagentoEse.lookBook widget
         * @private
         */
        _create: function () {
            $(this.element); // wrap this.element

            //modal(this.options, this.element);
            //this.popup.showPopup();
        }
    });

    return $.lookbook.popup;
});
