// var variables = require('services/variables');
// var cart = require('services/cart');
// var winSrv = require('services/window');

module.exports = backbone.View.extend({
    el: '.header',

    events: {
        'click .header__menu-button > a': 'onMenuButtonClick'
    },

    initialize: function initialize() {
        var onMdMaxMqlChange;

        this.ui = {
            $document: $(document),
            $navbar: this.$('.header__navbar'),
            $navList: this.$('.header__nav-list'),
            $cartButtonOuter: this.$('.header__cart-button-outer'),
            $cartButton: this.$('.header__cart-button'),
            $menuButton: this.$('.header__menu-button')
        };

        this.initializeStickyNavbar();

        onMdMaxMqlChange = $.proxy(function onMdMaxMqlChangeFn() {
            this.enableCartButtonMenu(!this.smMaxMql.matches);
            this.enableNavListMenu(!this.smMaxMql.matches);
        }, this);
        this.smMaxMql = window.matchMedia('(max-width: ' + variables.screenMdMax + 'px)');
        this.smMaxMql.addListener(onMdMaxMqlChange);
        onMdMaxMqlChange();
    },

    initializeStickyNavbar: function initializeStickyNavbar() {
        var onMdMaxMqlChange = $.proxy(function onMdMaxMqlChangeFn() {
            this.enableStickyNavbar(!this.mdMaxMql.matches);
        }, this);

        this.mdMaxMql = window.matchMedia('(max-width: ' + variables.screenMdMax + 'px)');
        this.mdMaxMql.addListener(onMdMaxMqlChange);
        onMdMaxMqlChange();
    },

    enableStickyNavbar: function enableStickyNavbar(enable) {
        var offsetTop;

        if (enable) {
            offsetTop = this.$('.header__top').outerHeight();

            this.ui.$navbar.affix({
                offset: { top: offsetTop }
            });
        } else {
            $(window).off('.affix');
            this.ui.$navbar
                .removeData('bs.affix')
                .removeClass('affix affix-top affix-bottom');
        }
    },

    enableNavListMenu: function enableNavListMenu(enable) {
        var menusSelector = '> li > ul';

        if (enable && this.navListMenu == null) {
            this.ui.$navList.menu({
                items: '> li',
                menus: menusSelector,
                position: {
                    my: 'left-1 top',
                    at: 'left bottom'
                }
            });
            this.navListMenu = this.ui.$navList.menu('instance');
        } else if (this.navListMenu) {
            this.navListMenu.destroy();
            this.ui.$navList.css({ display: '' })
                .find(menusSelector).css({
                display: '',
                top: '',
                left: ''
            });
            delete this.navListMenu;
        }
    },

    enableCartButtonMenu: function enableCartButtonMenu(enable) {
        var menusSelector = '> span > div';

        if (enable && this.cartButtonOuterMenu == null) {
            this.ui.$cartButtonOuter.menu({
                items: '> span',
                menus: menusSelector,
                position: {
                    my: 'right+1 top',
                    at: 'right bottom'
                }
            });
            this.cartButtonOuterMenu = this.ui.$cartButtonOuter.menu('instance');
            this.listenTo(cart, 'change:quantity', function onCartQuantityChange() {
                this.ui.$cartButton.trigger('mouseover');
            });
        } else if (this.cartButtonOuterMenu) {
            this.stopListening(cart, 'change:quantity');
            this.cartButtonOuterMenu.destroy();
            this.ui.$cartButtonOuter.find(menusSelector).css({
                display: '',
                top: '',
                left: ''
            });
            delete this.cartButtonOuterMenu;
        }
    },

    toggleMenu: function toggleMenu(show) {
        var isActive;

        this.ui.$menuButton.toggleClass('active', show);

        isActive = this.ui.$menuButton.hasClass('active');

        if (isActive) {
            this.ui.$document.on('click.header', $.proxy(this.onDocumentClick, this));
        } else {
            this.ui.$document.off('click.header');
        }

        winSrv.disableScrolling(isActive);
    },

    onMenuButtonClick: function onMenuButtonClick(e) {
        e.preventDefault();

        this.toggleMenu();
    },

    onDocumentClick: function onDocumentClick(e) {
        var $target = $(e.target);

        if (!$target.closest('.header__menu-button').length ||
            $target.closest('[href="/search"]').length ||
            $target.hasClass('header__menu-backdrop')) {
            this.toggleMenu(false);
        }
    }
});
