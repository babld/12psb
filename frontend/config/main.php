<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                #'<action>/test' => 'site/<action>',
                #'<action>/hello' => 'site/<action>',
                #'<action>' => 'site/<action>',
                #'<action>/<id:\d+>' => 'site/view',
                #'<catalog:[\w_\/-]+>/<id:[\d]+>'=>'site/view',
                '<action:contacts>'     => 'site/<action>',
                '<action:search>'       => 'site/<action>',
                '<action:delivery>'     => 'site/<action>',
                '<action:zakaz>'        => 'site/<action>',
                #'<action:google-feed>'  => 'site/<action>',
                '<action:test>' => 'site/<action>',
                [
                    'pattern' => '<action:google-feed>',
                    'route' => 'site/<action>',
                    'suffix' => '.xml',
                ],
                [
                    'pattern' => '<action:yml-feed>',
                    'route' => 'site/<action>',
                    'suffix' => '.xml',
                ],
                'blog'                  => 'blog/index',
                '<catalog:[\w_\/-]+>'   => 'site/catalog',
            ],
        ],

    ],
    'params' => $params,
];
