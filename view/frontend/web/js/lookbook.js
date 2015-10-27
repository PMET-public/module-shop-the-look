define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    '!domReady'
], function ($) {
    'use strict';

    $.widget('MagentoEse_LookBook.lookbook', $.mage.modal, {
        toggleModal: function (event) {
            this.options.loadUrl = $(event.currentTarget).data('load-url');
            this.options.viewPromoId = $(event.currentTarget).data('promo-id');
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
            $(':MagentoEse_LookBook-carousel').carousel('option', 'keysEnabled', false);
        },

        closeModal: function () {
            this._super();
            this.element.html('');
            $(':MagentoEse_LookBook-carousel').carousel('option', 'keysEnabled', true);
        }
    });

    $.widget('MagentoEse_LookBook.lookbookLoadDetail', {
        options: {
            listenEvent: null,
            loadUrl: null,
            elementSelector: null,
            defaultProductId: null,
            loaderUrl: null,
            loaderClass: "loader"
        },

        _create: function () {

            if (!this.options.loadUrl) {
                this.options.loadUrl = this.element.data('load-url');
            }

            var viewPromoId = $(':MagentoEse_LookBook-lookbook').lookbook('option', 'viewPromoId');
            if (viewPromoId) {
                this.options.defaultProductId = viewPromoId;
            }

            this.options.productId = this.element.data('product-id');
            if (this.options.defaultProductId != null && this.options.defaultProductId == this.options.productId) {
                this._load();
            }

            if (this.options.listenEvent) {
                this.element.on(this.options.listenEvent, this._load.bind(this));
            }

            $('body').addClass('catalog-product-view');
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
