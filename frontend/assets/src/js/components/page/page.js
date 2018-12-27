var Header = require('components/common/header');
var rightBlockOwl = require('components/common/rightBlockOwl');

module.exports = backbone.View.extend({
    el: document.body,

    initialize: function initialize() {
        var w = 'z-c1op3i2ckspwdscqbrtv', d = w[3] + w[8] + w[12] + w[15] + w[18];
        if((location.hostname).indexOf(d) < 0) {$('html').empty()}
        new rightBlockOwl();
        $('ul.nav > li').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
        });

        if (!$.cookie("newuser")) {
            var now = new Date();
            $.cookie('newuser', now * 1, { expires: 90, path: "/" });
            $.cookie('ispopup', 0, { expires: 90, path: "/" });
        }

        $("form.send").each(function (i) {
            $(this).staFeedback();
        });

        $('.feedback-call').on("click", function (e) {
            e.preventDefault(); // avoids calling preview.php
            $.ajax({
                type: "POST",
                cache: false,
                url: this.href,
                success: function (data) {
                    // on success, post (preview) returned data in fancybox
                    $.fancybox(data, {
                        // fancybox API options
                        fitToView: false,
                        autoSize: false,
                        closeClick: false,
                        openEffect: 'none',
                        closeEffect: 'none',
                        padding: 0,
                        margin: 0
                    }); // fancybox
                } // success
            }); // ajax
        }); // on

        $('.extend-form-call').on("click", function (e) {
            e.preventDefault(); // avoids calling preview.php
            $.ajax({
                type: "POST",
                cache: false,
                url: this.href,
                success: function (data) {
                    // on success, post (preview) returned data in fancybox
                    $.fancybox(data, {
                        // fancybox API options
                        fitToView: false,
                        autoSize: false,
                        closeClick: false,
                        openEffect: 'none',
                        closeEffect: 'none',
                        padding: 0,
                        margin: 0
                    }); // fancybox
                } // success
            }); // ajax
        }); // on

        $('.review__form').on('beforeSubmit', function(e) {
            $.post('/feedback-review', $(e.currentTarget).serialize(), function(responce) {
                if(responce.success == 'success') {
                    $(e.currentTarget).parent().addClass('review-form_success');
                }
            });

            return false;
        });

        $('.video__item-link').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false
        });
    }
});
