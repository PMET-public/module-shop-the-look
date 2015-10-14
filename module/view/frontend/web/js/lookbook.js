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
            activeProductId: 0,
        },

        _create: function () {
            if (!this.options.defer) {
                this._load()
            }

            if (!this.options.loadUrl) {
                this.options.loadUrl = this.element.data('load-url');
            }

            if (this.options.listenEvent) {
                this.element.on(this.options.listenEvent, this._load(self).bind(this))
            }

            var self = this;
            this._setActiveProductClass(self);
        },

        _load: function () {
            if (this.options.loadUrl) {
                var el = this.element;
                if (this.options.elementSelector) {
                    el = $(this.options.elementSelector);
                }
                if (this.options.defer) {
                    $(':mage-loader').loader('show');
                }

                el.load(this.options.loadUrl, function () {
                    $.mage.init();
                    $('.product-item').removeClass('active');
                    console.log(this.options.activeProductId);
                    $('.product-item:eq('+this.options.activeProductId+')').addClass('active');
                    if (this.options.defer) {
                        $(':mage-loader').loader('hide');
                    }
                }.bind(this));
            }
        },

        _setActiveProductClass: function (self) {
            $('._show .product-item').unbind('click');
            $('._show .product-item').on('click', function () {
                self.options.activeProductId = $('._show .product-item').index(this);
            });
        }
    });

    return {
        "MagentoEse_LookBook::lookbook": $.MagentoEse_LookBook.lookbook,
        "MagentoEse_LookBook::lookbookLoadDetail": $.MagentoEse_LookBook.lookbookLoadDetail
    }
});
