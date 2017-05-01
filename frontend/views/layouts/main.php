<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use app\models\SearchForm;

$modelSearch = new SearchForm();

AppAsset::register($this);
$this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Купить стенд ТНВД 12 PSB</title>
    <meta http-equiv="description" content="Стенды ТНВД за 399 000 рублей! В наличии на складе, доставка по всей России!">
    <meta http-equiv="keywords" content="Стенд 12psb, 12 psb Доставка из китая, 12psb в наличии в Новосибирске">
    <link rel="shortcut icon" href="/i/favicon.png" type="image/x-icon" />
    <?php $this->head() ?>
    <!--script type="text/javascript" async="" src="http://mc.yandex.ru/metrika/watch.js"></script>
    <meta name='yandex-verification' content='7761988de9d78f78' /-->
</head>

<body>
<?php $this->beginBody();
$catalogLabel = 'Каталог';
$menuItems = [
    ['label' => 'Главная',              'url' => '/'],
    ['label' => $catalogLabel,          'url' => '/site/catalog'],
    ['label' => 'Доставка и оплата',    'url' => '/site/delivery'],
    ['label' => 'Видео по работе',      'url' => '/site/video'],
    ['label' => 'Контакты',             'url' => '/site/contact'],
];?>
<div class="fixed-menu">
    <div class="container">
        <div class="navigator navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="sr-only">Открыть навигацию</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="row navbar-collapse collapse header__menu" id="responsive-menu">
                <div class="fl-r hidden-xs">
                    <div class="header-email">
                        <a href="mailto:<?=Yii::getAlias('@mail')?>">
                            <i class="fa fa-envelope corp-col" aria-hidden="true"></i>
                            <span><?=Yii::getAlias('@mail')?></span>
                        </a>
                    </div>
                    <div class="header-phone">
                        <a href="tel:<?=Yii::getAlias('@freephone')?>">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span><?=Yii::getAlias('@freephone')?></span>
                        </a>
                    </div>
                </div>

                <ul class="nav navbar-nav">
                    <li><a href="/">Главная</a></li>
                    <li class="dropdown">
                        <a href="/uslugi/" class="dropdown-toggle" data-toggle="dropdown">
                            Каталог
                            <span class="caret"></span>
                        </a>
                        <ul id="topnav" class="dropdown-menu" style="display: none;">
                            <li><a href="/catalog"><?=$catalogLabel?></a></li>
                            <li><a href="/catalog/stendy-tnvd">Стенды ТНВД</a></li>
                            <li><a href="/catalog/common-rail">Стенды Common Rail</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/delivery/">Доставка и оплата</a>
                    </li><?php /*
                <li>
                    <a href="/contacts/">Видео по работе</a>
                </li>*/?>
                    <li>
                        <a href="/contacts/">Контакты</a>
                    </li>
                </ul>


            </div>
        </div>
    </div>
</div>

<div class="header gray-block-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <a href="/" class="header-logo"></a>
            </div>
            <div class="col-lg-5">
                <div class=" header-text">
                    <div class="header-title">
                        Стенды ТНВД и Common Rail
                    </div>
                    <div class="header-subtitle">
                        Топливное оборудование в наличии и под заказ.
                    </div>
                </div>
            </div>
            <div>
                <form class="header-form send">
                    <i>+7</i>
                    <input type="text" placeholder="(___) ___ __ __" name="phone" class="header-form-phone">
                    <input type="submit" name="submit" class="header-form-submit but-default" value="Жду звонка">
                </form>
                <form class="search-form" action="/search">
                    <input type="text" name="query" class="search-form__input" placeholder="Поиск.." value="<?=Yii::$app->getRequest()->getQueryParam('query');?>"/>
                    <button type="submit" value="" class="search-form__submit fa fa-search"></button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php /*
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]) ?>
</div>*/ ?>

<?= Alert::widget() ?>
<?= $content ?>

<?=$this->render('/blocks/footer');?>

<?php $this->endBody(); ?>
<script type="text/javascript">
    jQuery(function($){$('input[placeholder],textarea[placeholder]').placeholder();});

    audiojs.events.ready(function() {
        audiojs.createAll();
    });
</script>
<?php ?>
</body>
</html>
<?php $this->endPage(); ?>
