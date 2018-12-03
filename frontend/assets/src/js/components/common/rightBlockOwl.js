module.exports = backbone.View.extend({
    el: '.article__main',

    initialize: function initialize() {
        $('.article__right-owl').owlCarousel({
            margin: 1,
            autoplay: false,
            nav: false,
            loop: false,
            lazyLoad: true,
            responsive: {
                0: {
                    items: 1
                }
            }
        });
    }
})
