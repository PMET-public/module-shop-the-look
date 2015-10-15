define([
    'jquery',
    'MagentoEse_LookBook/js/lib/owl.carousel',
    '!domReady'
], function ($) {
    'use strict';

    $.widget('MagentoEse_LookBook.carousel', {
        options: {},

        /**
         * Create MagentoEse_LookBook.carousel widget
         * @private
         */
        _create: function () {
            this.element.addClass('owl-carousel');
            var owl = this.element.owlCarousel(this.options);

            this._redrawOnResize(owl);
            this._addNavButtons(owl);
            this._setKeyboardControlls(owl);
        },

        _setKeyboardControlls: function (owl) {
            $(document).keyup(function(e){
                if (e.keyCode == 37) {
                    owl.trigger('prev.owl.carousel');
                } else if (e.keyCode == 39) {
                    owl.trigger('next.owl.carousel');
                }
            });
        },
        _redrawOnResize: function (owl) {
            // After resizing window in Chrome, drawing issues cause other slides to show under current slide.
            // Since there are no other apparent solutions, triggering a redraw is the best way of fixing this issue.
            owl.on("resize.owl.carousel",function(e){
                owl.hide().show(0);
            });
        },
        _addNavButtons: function (owl) {
            $('.column.main .prev').click(function(){
                owl.trigger('prev.owl.carousel');
            });
            $('.column.main .next').click(function(){
                owl.trigger('next.owl.carousel');
            });
        }
    });

    return $.MagentoEse_LookBook.carousel;
});
