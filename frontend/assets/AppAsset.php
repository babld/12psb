<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = YII_ENV_DEV ? '@frontend/assets/dist/dev' : '@frontend/assets/dist/prod';
    public $baseUrl = '@web';
    public $css = [
        YII_ENV_DEV ? 'css/all.css' : 'css/all.min.css',
    ];
    public $js = [
        YII_ENV_DEV ? 'js/vendor.js' : 'js/vendor.min.js',
        YII_ENV_DEV ? 'js/all.js' : 'js/all.min.js',
    ];
    public $depends = [];
    public $publishOptions = [
        'only' => [
            '*.min.css',
            '*.min.js',
        ],
    ];
}
