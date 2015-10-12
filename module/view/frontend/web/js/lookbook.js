define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    '!domReady'
], function ($) {
    'use strict';

    $.widget('MagentoEse_LookBook.lookbook', $.mage.modal, {
        toggleModal: function (event) {
            this.options.loadUrl = $(event.toElement).data('load-url');
            this._super();
        },

        openModal: function () {
            this._super();
            if (this.options.loadUrl) {
                this.element.load(this.options.loadUrl)
            }
        },

        closeModal: function () {
            this._super();
            this.element.html('');
        }
    });

    return $.MagentoEse_LookBook.lookbook;
});
