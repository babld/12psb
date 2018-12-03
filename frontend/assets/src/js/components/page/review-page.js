var Page = require('components/page/page');
var AudioJs = require('plugins/audio.min');

module.exports = Page.extend({
    initialize: function initialize() {
        Page.prototype.initialize.apply(this, arguments);
        AudioJs.audiojs.createAll();
        console.log('review');

    }
});
