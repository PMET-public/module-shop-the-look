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
                this.openModal_super = this._super;
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

    $.widget('MagentoEse_LookBook.lookbookLoadDetail', {
        options: {
            defer: true,
            listenEvent: null,
            loadUrl: null,
            elementSelector: null,
            loaderUrl: null,
            loaderClass: "loader"
        },

        _create: function () {

            if (!this.options.loadUrl) {
                this.options.loadUrl = this.element.data('load-url');
            }

            this.options.defer = this.element.data('defer');
            if (!this.options.defer) {
                this._load()
            }

            if (this.options.listenEvent) {
                this.element.on(this.options.listenEvent, this._load.bind(this))
            }
        },

        _load: function () {
            if (this.options.loadUrl) {
                var el = $(this.options.elementSelector);

                el.html('');
                el.append($('<div/>')
                    .addClass(this.options.loaderClass)
                    .append($('<img/>').attr('src', this.options.loaderUrl))
                );

                $(':' + this.widgetFullName).removeClass('active');
                this.element.addClass('active');

                el.load(this.options.loadUrl, function () {
                    $.mage.init();
                }.bind(this));
            }
        }
    });

    return {
        "MagentoEse_LookBook::lookbook": $.MagentoEse_LookBook.lookbook,
        "MagentoEse_LookBook::lookbookLoadDetail": $.MagentoEse_LookBook.lookbookLoadDetail
    }
});
