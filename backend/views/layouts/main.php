<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="glyphicon glyphicon-home blue" style="color: #c9c9ff;"></i> ' . Yii::$app->name,
        // 'brandUrl' => Yii::$app->homeUrl,
        'brandUrl' => Url::to(['/']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

	if(Yii::$app->user->id) {
        $navList = [
            'options' => ['class' => 'navbar-nav navbar-right main-menu'],
            'encodeLabels' => false,
            'items'=>[
                    [
                        'label'=> 'Отчёты',
                        'url' => '#',
                        'items'=>[
                            ['label'=>'Заказы', 'url'=>['/order/order']],
                         ]
                    ],
                    [
                        'label'=> 'Справочники',
                        'url' => '#',
                        'items'=>[
                            ['label'=>'Витрина', 'url'=>['/shop/product/index']],
                            ['label'=>'Промокоды', 'url'=>['/promocode/promo-code/index']],
                            ['label'=>'Пользователи', 'url'=>['/user/admin/index'],],
                            ['label' => 'Клиенты', 'url' => ['/client/client/index']]
                         ]
                    ],

                    [
                        'label'=> '<i class="glyphicon glyphicon-cog"></i>',
                        'url' => '#',
                        'items'=>[
                            ['label' => 'Фильтры', 'url'=>['/filter/filter']],
                            ['label' => 'Поля магазина', 'url'=>['/field/field']],
                            ['label' => 'Поля заказа', 'url' => ['/order/field/index']],
                         ]
                    ],
                    ['label' => yii::$app->user->getIdentity()->username, 'url' => '#', 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                    '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выйти (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                    . '</li>'
                ]
        ];
		echo Nav::widget($navList);
	} else {
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				[
					'label' => 'Вход',
					'url' => '/user/login',
				],
			]
		]);
	}

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
