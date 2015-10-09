define([
    'jquery',
    'mage/translate',
    'matchMedia',
    'MagentoEse_LookBook/js/lib/owl.carousel',
    '!domReady'
], function ($, owlCarousel){
    'use strict';

    $.widget('MagentoEse_LookBook.popup', {
        options: {
            type: 'popup',
            title: $.mage.__('Shop this Look'),
            modalClass: 'lookbook-popup',
            responsive: true,
            innerScroll: true,
            buttons: []
        },

        /**
         * Create MagentoEse_LookBook.popup widget
         * @private
         */
        _create: function () {
            var self = this;
            var element = $(self.element);
            element.addClass('owl-carousel');
            var owl = $(self.element).owlCarousel(self.options);
            self._redrawOnResize(owl);
            self._addNavButtons(owl);
            self._setKeyboardControlls(owl);
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
                console.log("resize");
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

    return $.MagentoEse_LookBook.popup;
});
