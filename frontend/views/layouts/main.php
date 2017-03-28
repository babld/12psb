<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
    <script type="text/javascript" async="" src="http://mc.yandex.ru/metrika/watch.js"></script>
    <meta name='yandex-verification' content='7761988de9d78f78' />
    <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
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
            <div class="navbar-collapse collapse" id="responsive-menu">
                <div class="nav navbar-nav navbar-right">
                    <div class="header-email">
                        <a href="mailto:info@12psb.ru">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            info@12psb.ru
                        </a>
                    </div>
                    <div class="header-phone">
                        <a href="tel:88007756758">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            8-800-775-6758
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
                            <li><a href="uslugi/dostavka-gruzov/">Доставка грузов</a></li>
                            <li><a href="uslugi/logistic/">Логистическая обработка и сопровождение</a></li>
                            <li><a href="uslugi/finansovoe-soprovozhdenie-ved/">Финансовое сопровождение ВЭД сделок</a></li>
                            <li><a href="uslugi/svh/">Хранение и оформление грузов на собственном СВХ</a></li>
                            <li><a href="uslugi/sertification/">Сертификация товаров из Китая</a></li>
                            <li><a href="uslugi/outsourcing-ved/">Аутсорсинг ВЭД</a></li>
                            <li><a href="uslugi/poisk-tovarov-v-kitae/">Поиск товаров</a></li>
                            <li><a href="uslugi/tamozhennoe-oformlenie/">Таможенное оформление</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/goods/">Доставка и оплата</a>
                    </li>
                    <li>
                        <a href="/contacts/">Видео по работе</a>
                    </li>
                    <li>
                        <a href="/contacts/">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="header">
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
            <div class="col-lg-3">
                <form class="header-form">
                    <i>+7</i>
                    <input type="text" placeholder="(___) ___ __ __" name="phone" class="header-form-phone">
                    <input type="submit" name="submit" class="header-form-submit" value="Жду звонка">
                </form>
            </div>
        </div>
    </div>
</div>

<!--div class="container"-->
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
<!--/div-->


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 12psb <?= date('Y'); ?></p>

        <p class="pull-right"><?= Yii::powered(); ?></p>
    </div>
</footer>

<?php $this->endBody(); ?>
<script type="text/javascript">
    jQuery(function($){$('input[placeholder],textarea[placeholder]').placeholder();});
</script>
<script>
    audiojs.events.ready(function() {
        audiojs.createAll();
    });
</script>
<script>
    $(document).ready(function(){
        $(".main-block-slider").carouFredSel({
            items               : {
                visible			: 1,
                start			: 0				},
            direction           : "up",
            auto				: true,
            scroll : {
                items            : 1,
                //easing            : "elastic",
                duration        : 1000,
                pauseOnHover    : true
            },
            pagination	: ".main-block-slider-pagination"
        });
    });
</script>
</body>
</html>
<?php $this->endPage(); ?>
