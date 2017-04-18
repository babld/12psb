<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fonts.css',
        'css/bootstrap.css',
        'css/style.css',
        'css/index.css',
        'css/overlay.css',
        '/css/jquery.fancybox.css',
        'css/font-awesome.css',
        '/css/owl.carousel.min.css',
        '/css/owl.theme.default.css'
    ];
    public $js = [
        '/js/bootstrap.js',
        '/js/owl.carousel.min.js',
        '/js/jquery.fancybox.pack.js',
        '/js/jquery.cookie.js',
        '/js/jquery.inputmask.bundle.min.js',
        '/js/jquery.fancybox.pack.js',
        '/js/jquery.validate.min.js',
        '/js/jquery.maskedinput.js',
        '/js/additional-methods.js',
        '/js/jquery.staFeedback.js',
        '/js/jquery.placeholder.js',
        '/js/jquery.carouFredSel-6.0.0-packed.js',
        '/js/common.js',
        '/js/audio.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
