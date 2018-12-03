var Header = require('components/common/header');
var rightBlockOwl = require('components/common/rightBlockOwl');
//var CartElements = require('components/common/cart-elements');
//var Feedback = require('components/common/feedback');

module.exports = backbone.View.extend({
    el: document.body,

    initialize: function initialize() {
        new rightBlockOwl();
        $('ul.nav > li').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
        });

        if (!$.cookie("newuser")) {
            //console.log("новый юзер");
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

        $(".footer-fillials li").click(function(){
            console.log('footer click');
            city = $(this).attr("data-city");
            phoneContainer = $(".footer-contacts-phone");
            addressContainer = $(".footer-contacts-address");
            $(this).parent().find("li").removeClass("active");
            $(this).addClass("active");
            switch(city){
                case "nsk":
                    phoneContainer.text("8-383-207-8860");
                    addressContainer.text("пр. Дзержинского, 1/1, оф. 71");
                    break;
                case "omsk":
                    phoneContainer.text("8-381-297-2030");
                    addressContainer.text("ул. Маяковского, 81");
                    break;
                case "msk":
                    phoneContainer.text("8-499-346-6799");
                    addressContainer.text("ул. Сущевский Вал, 5, стр. 3.");
                    break;
                case "spb":
                    phoneContainer.text("8-812-424-3313");
                    addressContainer.text("просп. Обуховской Обороны, 271");
                    break;
                case "ekb":
                    phoneContainer.text("8-343-345-6532");
                    addressContainer.text("ул. Завокзальная 5а, офис 306");
                    break;
            }
        });

        $('.review__form').on('beforeSubmit', function(e) {
            //console.log($(e.currentTarget).parent());
            $.post('/feedback-review', $(e.currentTarget).serialize(), function(responce) {
                if(responce.success == 'success') {
                    $(e.currentTarget).parent().addClass('review-form_success');
                    console.log('yes review ok');
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
