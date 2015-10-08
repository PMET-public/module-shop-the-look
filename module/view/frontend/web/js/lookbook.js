define([
    'jquery',
    'MagentoEse_LookBook/js/lib/owl.carousel',
    '!domReady'
], function ($, owlCarousel){
    'use strict';

    $.widget('MagentoEse.lookBook', {
        /**
         * Create MagentoEse.lookBook widget
         * @private
         */
        _create: function () {
            $(this.element).addClass('owl-carousel');
            $(this.element).owlCarousel(this.options);
        }
    });

    return $.MagentoEse.lookBook;
});