/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'jquery',
    'mage/translate',
    'Magento_Catalog/js/catalog-add-to-cart',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/confirm'
], function($, $t, $c, alert, confirm) {
    "use strict";

    $.widget('MagentoEse.lookbookAddToCart', $.mage.catalogAddToCart, {
        options: {
            messagesSelector: '.lookbook .product-item.active',
            urlToCart: null
        },
        ajaxSubmit: function(form) {
            var self = this;
            $(self.options.minicartSelector).trigger('contentLoading');
            self.disableAddToCartButton(form);

            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    if (self.isLoaderEnabled()) {
                        $('body').trigger(self.options.processStart);
                    }
                },
                success: function(res) {
                    if (self.isLoaderEnabled()) {
                        $('body').trigger(self.options.processStop);
                    }
                    $(self.options.messagesSelector).addClass('added-to-cart');
                    if (res.minicart) {
                        $(self.options.minicartSelector).replaceWith(res.minicart);
                        $(self.options.minicartSelector).trigger('contentUpdated');
                    }
                    if (res.product && res.product.statusText) {
                        $(self.options.productStatusSelector)
                            .removeClass('available')
                            .addClass('unavailable')
                            .find('span')
                            .html(res.product.statusText);
                    }
                    self.enableAddToCartButton(form);
                    if ($('.lookbook .product-item:not(.added-to-cart)').length) {
                        $('.lookbook .product-item:not(.added-to-cart, .active)')[0].click();
                    }
                    else {
                        $(':MagentoEse_LookBook-lookbook').trigger('closeModal');
                        alert({
                            title: "You've got the look!",
                            content: "",
                            modalClass: "confirm lookbook-look-added",
                            actions: {
                                always: function(){},
                                confirm: function(){},
                                cancel: function(){}
                            },
                            buttons: [{
                                text: $.mage.__('View Bag'),
                                class: 'action-primary',
                                click: function(){
                                    this.closeModal();
                                    window.location.href = self.options.urlToCart;
                                }
                            }, {
                                text: $.mage.__('Continue Shopping'),
                                class: 'action-secondary',
                                click: function() {
                                    this.closeModal(true);
                                }
                            }]
                        });
                    }
                }
            });
        }
    });

    return $.MagentoEse.lookbookAddToCart;
});
