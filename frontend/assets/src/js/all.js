var camelCase = require('lodash/camelCase');
var isFunction = require('lodash/isFunction');
var raf = require('raf');
var Page = require('components/page/page');

/* eslint-disable global-require */
var pages = {
    index: require('components/page/index-page'),
    review: require('components/page/review-page')
    //contacts: require('components/page/contacts'),
    //catalog: require('components/page/catalog'),
    //article: require('components/page/article'),
    //cart: require('components/page/cart-page'),
    //orders: require('components/page/orders-page'),
    //wishlist: require('components/page/wishlist-page'),
    //feedback: require('components/page/feedback-page')
};
/* eslint-enable global-require */

raf.polyfill();
window.__forceSmoothScrollPolyfill__ = true; // eslint-disable-line no-underscore-dangle

// Плагины
//require('./plugins/owl-carousel');
//require('./plugins/count-spinner');
// require('./plugins/magnific-popup');
require('./plugins/yii');
require('./plugins/yii.activeForm');
require('./plugins/yii.validation');
require('./plugins/jquery.validate.min');
require('./plugins/jquery.staFeedback');


(function bootstrap(components) {
    var componentName = camelCase($(document.body).data('component'));
    var Component = components[componentName];

    if (Component && isFunction(Component)) {
        new Component(); // eslint-disable-line no-new
    } else {
        new Page(); // eslint-disable-line no-new
    }
}(pages));