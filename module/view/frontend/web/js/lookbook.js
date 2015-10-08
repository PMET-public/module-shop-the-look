define([
    'jquery',
    'MagentoEse_LookBook/js/lib/owl.carousel',
    'Magento_Ui/js/modal/modal',
    'mage/translate'
], function ($, owlCarousel, modal){
    'use strict';

    $.widget('MagentoEse.lookbook.gallery', {
        options: {
            carouselOptions: {},
            carouselSelector: '.lookbook-carousel',
            popupOptions: {
                type: 'popup',
                title: $.mage.__('Shop this Look'),
                modalClass: 'lookbook-popup',
                responsive: true,
                innerScroll: true,
                buttons: []
            },
            popupSelector: '.lookbook-popup'
        },

        carousel: null,
        popup: null,

        /**
         * Create MagentoEse.lookBook widget
         * @private
         */
        _create: function () {
            $(this.element); // wrap this.element

            this.carousel = $(this.element.children(this.options.carouselSelector)[0]);
            this.carousel.addClass('owl-carousel');
            this.carousel.owlCarousel(this.options.carouselOptions);

            this.popup = $(this.element.children(this.options.popupSelector)[0]);
            modal(this.options.popupOptions, this.popup);
        },
    });

    return $.MagentoEse.lookbook.gallery;
});
