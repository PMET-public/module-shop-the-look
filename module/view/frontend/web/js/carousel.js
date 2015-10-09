define([
    'jquery',
    'MagentoEse_LookBook/js/lib/owl.carousel'
], function ($) {
    'use strict';

    $.widget('MagentoEse_LookBook.carousel', {
        options: {},

        /**
         * Create MagentoEse_LookBook.carousel widget
         * @private
         */
        _create: function () {
            $(this.element); // wrap this.element

            this.element.addClass('owl-carousel');
            this.element.owlCarousel(this.options);
        }
    });

    return $.MagentoEse_LookBook.carousel;
});
