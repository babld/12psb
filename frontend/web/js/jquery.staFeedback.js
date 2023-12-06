(function( $ ){
    $.fn.staFeedback = function(options) {

        var settings = $.extend({
            'overlay' : false
        }, options);

	    var thisForm = this;

	    thisForm.validate({
            rules: {
                name: {
                    required:true
                },
                phone: {
                    required:true
					//ruPhoneFormat: true
                },
	            email: {
		            required: true,
		            email: true
	            }//,
	            /*mess: {
		            required: true
	            }*/
            },

            messages: {
                name: {
                    required: "Представьтесь пожалуйста"
                },
                phone: {
                    required: "Введите телефон"
                },
	            email: {
		            required: "Введите email",
		            email: "Email введен не корректно"
	            },
	            mess: {
		            required: "Введите сообщение"
	            }
            },

            errorPlacement: function(error, element) {
                error.insertBefore(element);
            },

	        /*highlight: function(element, errorClass, validClass) {
		        var e = $(element);
		        e.addClass(errorClass);
		        $('#' + e.attr('name') + 'error1').parent().addClass('error1');
	        },
	        unhighlight: function(element, errorClass, validClass) {
		        var e = $(element);
		        e.removeClass(errorClass);
		        $('#' + e.attr('name') + 'error1').parent().removeClass('error1');
	        },*/

            submitHandler: submit
        });
		
		//this.find("input[name='phone']").mask("9(999) 999-99-99");

        function submit(form){
	        $.post(
                '/ajax-feedback.php',
                $(form).serialize(),
                parseResponce);

	        $(thisForm).find("input[name='submit']").attr('disabled', 'disabled');
        };

        function parseResponce(response) {
            if(typeof(response.post.target)!= "undefined" && "yaCounter24717443" in window) {
                yaCounter24717443.reachGoal(response.post.target);
            }

            if(typeof(response.post.target)!= "undefined" && "ga" in window) {
                ga('send', 'event', response.post.target, '2');
            }

            if(!settings.overlay) {
                $(".form-wrapper").replaceWith("<div class='thankyou-bot'>Спасибо за заказ. <br/><span>Мы свяжемся с Вами в ближайшее время</span></div>");
            } else {
                $(".lightbox-wrap").replaceWith("<div class='thankyou'>Спасибо за заказ.<br/><span>Мы свяжемся с Вами в ближайшее время.</span></div>");
            }
            thisForm.trigger('reset');

	        $(thisForm).find("input[name='submit']").removeAttr('disabled');
        }
    }
})(jQuery);
