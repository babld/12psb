var Page = require('components/page/page');

module.exports = Page.extend({
    initialize: function initialize() {
        $(".tovar__gallery").owlCarousel({
            items: 1,
            autoplay: false,
            lazyLoad:true,
            loop: true,
            margin: 10,
            nav:false
        });

        $('.fancybox').fancybox({
            padding: 15,
            scrolling: 'auto',
            wrapCSS: "order-wrap"
        });
    }
});