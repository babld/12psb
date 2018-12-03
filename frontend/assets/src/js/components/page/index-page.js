var Page = require('components/page/page');
var AudioJs = require('plugins/audio.min');
// var config = require('services/config');

module.exports = Page.extend({
    initialize: function initialize() {
        console.log('index');
        Page.prototype.initialize.apply(this, arguments);
        this.initializeCarousel();
    },

    initializeCarousel: function initializeCarousel() {
        $(".main-block-slider").owlCarousel({
            loop: true,
            responsive: {
                0: {
                    items: 1
                }
            }
        });

        $('.order-stend-list').owlCarousel({
            margin: 10,
            autoplay: true,
            nav: false,
            loop: false,
            lazyLoad:true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1150: {
                    items: 4
                }
            }
        });

        $('.video-owl-carousel, .owl-three').owlCarousel({
            margin: 10,
            autoplay: true,
            nav: false,
            loop: false,
            lazyLoad:true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                900: {
                    items: 3
                }
            }
        });

        $('.lbox').fancybox({
            padding: 10
        });

        AudioJs.audiojs.createAll();
    }
});
