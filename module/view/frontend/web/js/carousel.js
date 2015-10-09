define([
    'jquery',
    'MagentoEse_LookBook/js/lib/owl.carousel'
], function ($) {
    'use strict';

    $.widget('lookbook.carousel', {
        options: {},

        /**
         * Create MagentoEse.lookBook widget
         * @private
         */
        _create: function () {
            $(this.element); // wrap this.element

            this.element.addClass('owl-carousel');
            this.element.owlCarousel(this.options);
        }
    });

    return $.lookbook.carousel;
});
