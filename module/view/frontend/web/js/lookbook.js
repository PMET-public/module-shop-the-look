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
            if (this.options.loadUrl) {
                var self = this;
                self.openModal_super = self._super;

                $(':mage-loader').loader('show');
                this.element.load(this.options.loadUrl, function () {
                    $.mage.init();
                    $(':mage-loader').loader('hide');
                    this.openModal_super();
                }.bind(this))
            }
        },

        closeModal: function () {
            this._super();
            this.element.html('');
        }
    });

    function lookbookLoadDetail(config, element)
    {
        $(element).load(config.loadUrl);
    }

    return {
        "MagentoEse_LookBook::lookbook": $.MagentoEse_LookBook.lookbook,
        "MagentoEse_LookBook::lookbookLoadDetail": lookbookLoadDetail
    }
});
