$(document).ready(function() {

	var search = ' newuser=';
	var cookie = ' ' + document.cookie;

	$('ul.nav > li').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
	});

	$(".tovar__gallery").owlCarousel({
        items: 1,
        autoplay: false,
        //animateOut: 'fadeOut',
        loop: true,
        margin: 10,
        nav:false
    });

	$(".certs__gallery").owlCarousel({
        margin: 10,
        autoplay: true,
        nav: false,
        loop: false,
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

    var owl = $('.order-stend-list');
	owl.owlCarousel({
		margin: 10,
        autoplay: true,
		nav: false,
		loop: false,
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

	$(".main-block-slider").owlCarousel({

        loop: true,
        responsive: {
            0: {
                items: 1
            }
        }
	});



    if (!$.cookie("newuser")) {
		//console.log("новый юзер");
		var now = new Date();
		$.cookie('newuser', now * 1, { expires: 90, path: "/" });
		$.cookie('ispopup', 0, { expires: 90, path: "/" });
	} else {
		//console.log("не новый юзер");
	}
	//popup();
    /* FEEDBACK FORM */
    jQuery.validator.addMethod("ruPhoneFormat", function (value, element) {
		if (value != "(___) ___-__-__") {
			return this.optional(element) || /\(\d{3}\) \d{3}\-\d{2}-\d{2}?$/.test(value);
		} else {
			return true;
		}
    }, "Введите телефон правильно");
	$("form.send").each(function (i) {
		$(this).staFeedback();
	});
	
	$('.fancybox').fancybox({
		padding: 15,
		scrolling: 'auto',
		wrapCSS: "order-wrap"
	});
	
	$('.lbox').fancybox({
		padding: 10
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

    function cityIP(){
        $.getJSON('/common/user_info.js.php',
		
        function(result) {
			var ip = result.ip;
			  
			$.ajax({
				type: "GET",
				url: "http://ipgeobase.ru:7020/geo?ip="+ip,
				dataType: "xml",
				cache: false,
				success: function(xml) {
					var region = $(xml).find('region').text();
					var district = $(xml).find('district').text();
                    var addressContainer = $(".contacts__left .company-address");
                    var phoneContainer = $(".contacts__left .region-phone, .header .region-phone");
				   
					switch(district){						
						case "Центральный федеральный округ":
							phoneContainer.html("8 (499) 346-67-99");
							addressContainer.html("&nbsp;");
						break;
						
						case "Северо-Западный федеральный округ":
							phoneContainer.html("8 (812) 424-33-13");
							addressContainer.html("&nbsp;");
						break;	
						
						case "Уральский федеральный округ":
							phoneContainer.html("8 (343) 345-65-32");
							addressContainer.html("&nbsp;");
						break;
						default:
							phoneContainer.html("8 (383) 207-88-60");
                            addressContainer.html("Новосибирск, пр-т Дзержинского, 1/1, 5 этаж, офис 71");
					}	

					switch(region){
						case "Омская область":
							phoneContainer.html("");
						break;
						
						case "Томская область":
							phoneContainer.html("8 (381) 297-20-30");
						break;														
					}  
				},
				error: function() { cityIP();  }
			});
		});
    }
    
    //cityIP();

	$(".footer-fillials li").click(function(){
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
    
});