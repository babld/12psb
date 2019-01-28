// var variables = require('services/variables');
// var cart = require('services/cart');
// var winSrv = require('services/window');

module.exports = backbone.View.extend({
    el: '.feedback',

    events: {
        'beforeSubmit .feedback__form': 'onFeedbackFormBeforeSubmit'
    },

    initialize: function initialize() {
        this.ui = {
            $form: this.$('.feedback__form')
        };
    },

    onFeedbackFormBeforeSubmit: function onFeedbackFormBeforeSubmit() {
        $.post(
            this.ui.$form.attr('action'),
            this.ui.$form.serialize(),
            function() {
                $('.feedback').empty().append('<div class="thankyou-message">Спасибо</div>');
            }
        );

        return false;
    }
});
