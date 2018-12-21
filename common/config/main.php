<?php
return [
    'name' => '12PSB.RU',
	'sourceLanguage' => 'ru',
    'language' => 'ru-RU',
	'timeZone' => 'Etc/GMT-3',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'extensions' => yii\helpers\ArrayHelper::merge(
        require(dirname(dirname(__DIR__)) . '/vendor/yiisoft/extensions.php'),
        [
            'pistol88/yii2-seo' => [
                'name' => 'pistol88/yii2-seo',
                'version' => '@dev',
                'alias' =>
                    [
                        '@dvizh/order' => dirname(dirname(__DIR__)) . '/common/modules/dvizh/yii2-order/src',
                    ],
            ],
            'dvizh/yii2-promocode' => [
                'name' => 'dvizh/yii2-promocode',
                'version' => '@dev',
                'alias' =>
                    [
                        '@dvizh/promocode' => dirname(dirname(__DIR__)) . '/common/modules/dvizh/yii2-promocode/src',
                    ],
            ],
            'halumein/wishlist' => [
                'name' => 'halumein/wishlist',
                'version' => '@dev',
                'alias' =>
                    [
                        '@halumein/wishlist' => dirname(dirname(__DIR__)) . '/common/modules/halumein/yii2-wishlist',
                    ],
            ],
        ]
    ),
    'components' => [
        'assetManager' => [
            //'forceCopy' => true,
            'linkAssets' => true,
            'appendTimestamp' => true
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'class' => 'yii\web\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-common', 'httpOnly' => true],
        ],
        'cart' => [
            'class' => 'pistol88\cart\Cart',
            'currency' => 'р.', //Валюта
            'currencyPosition' => 'after', //after или before (позиция значка валюты относительно цены)
            'priceFormat' => [0,'.', ''], //Форма цены
            'as ElementDiscount' => ['class' => 'pistol88\promocode\behaviors\Discount'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],
        'client' => [
            'class' => 'pistol88\client\Client',
        ],
    ],
    'modules' => [
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
            'admins' => ['pistol'],
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['pistol'],
        ],
        'gallery' => [
            'class' => 'pistol88\gallery\Module',
            'imagesStorePath' => dirname(dirname(__DIR__)) . '/frontend/web/images/store', //path to origin images
            'imagesCachePath' => dirname(dirname(__DIR__)) . '/frontend/web/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => '@webroot/images/placeHolder.png',
        ],
        'filter' => [
            'class' => 'pistol88\filter\Module',
            'relationFieldName' => 'category_id', //Наименование поля, по значению которого будут привязыватья опции
            //callback функция, которая возвращает варианты relationFieldName
            'relationFieldValues' =>
                function() {
                    //Пример с деревом:
                    $return = [];
                    $categories =  \pistol88\shop\models\Category::find()->all();
                    foreach($categories as $category) {
                       if(empty($category->parent_id)) {
                            $return[] = $category;
                            foreach($categories as $category2) {
                                if($category2->parent_id == $category->id) {
                                    $category2->name = ' --- '.$category2->name;
                                    $return[] = $category2;
                                }
                            }
                       }
                    }
                    return \yii\helpers\ArrayHelper::map($return, 'id', 'name');
                },
        ],
        'cart' => [
            'class' => 'pistol88\cart\Module',
        ],
        'shop' => [
            'class' => 'pistol88\shop\Module',
            // 'defaultTypeId' => '2', //Это цена, выводимая по умолчанию (ID типа цен)
            'adminRoles' => ['administrator', 'seller'],
        ],
        'field' => [
            'class' => 'pistol88\field\Module',
            'relationModels' => [
                'common\models\User' => 'Пользователи',
                'pistol88\staffer\models\Staffer' => 'Сотрудники',
                'pistol88\client\models\Client' => 'Клиенты',
                'pistol88\shop\models\Product' => 'Продукты',
                'pistol88\shop\models\Category' => 'Категории',
                'pistol88\shop\models\Producer' => 'Производители',
            ],
            'adminRoles' => ['superadmin', 'administrator'],
        ],
        'order' => [
            'class' => 'pistol88\order\Module',
            'userModel' => 'pistol88\client\models\Client',
            'userSearchModel' => 'pistol88\client\models\client\ClientSearch',
            'userModelCustomFields' => ['code', 'birthday'],
            'adminMenu' => ['orders', 'field', 'payment-type'],
            'successUrl' => '/order/info/thanks/', //Страница, куда редиректится покупатель после создания заказа
            'productCategories' => function() { 
                return \yii\helpers\ArrayHelper::map(\pistol88\shop\models\Category::find()->all(), 'id', 'name');
            },
            'orderColumns' => ['client_name', 'payment_type_id', ['field' => 2, 'label' => 'Автомобиль']],
            'adminRoles' => ['superadmin', 'administrator'],
            'ordersEmail' => false, //Мыло для отправки заказов
            'on create' => function($event) {
                //Отправляем свои собственные письма, заказ в $event->model, елементы в $event->model->elements
            },
            'orderStatuses' => ['new' => 'Новый', 'approve' => 'Подтвержден', 'cancel' => 'Отменен', 'process' => 'В обработке', 'done' => 'Выполнен',],
        ],
        'promocode' => [
            'class' => 'pistol88\promocode\Module',
            'usesModel' => 'dektrium\user\models\User', //Модель пользователей
            //Указываем модели, к которым будем привязывать промокод
            'targetModelList' => [
                'Категории' => [
                    'model' => 'pistol88\shop\models\Category',
                    'searchModel' => 'pistol88\shop\models\category\CategorySearch'
                ],
                'Продукты' => [
                    'model' => 'pistol88\shop\models\Product',
                    'searchModel' => 'pistol88\shop\models\product\ProductSearch'
                ],            
            ],
        ],
        'relations' => [
            'class' => 'pistol88\relations\Module',
            'fields' => ['code'],
        ],
    ]
];
