<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use app\models\SearchForm;
use app\components\Helper;

$modelSearch = new SearchForm();
$utmData = Helper::getUtmData();

AppAsset::register($this);
$this->beginPage();
$month = (int)date('m');
$day = (int)date('j');
$newYearTime = ($month == 12 and $day >= 15 or $month == 1 and $day < 15);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <?php $this->head() ?>
    <?php if(YII_ENV == 'prod') : ?>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function (d, w, c) { (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter24717443 = new Ya.Metrika({
                        id:24717443, webvisor:true, clickmap:true,
                        trackLinks:true, accurateTrackBounce:true,
                        trackHash:true});
                } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script>
        <noscript><div><img src="//mc.yandex.ru/watch/24717443" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

        <!--script type="text/javascript" async="" src="http://mc.yandex.ru/metrika/watch.js"></script>
        <meta name='yandex-verification' content='7761988de9d78f78' /-->
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-5GF6P9Q');</script>
        <!-- End Google Tag Manager -->

        <!-- Kill sovetnik -->
        <script>
            (function(open) {
                XMLHttpRequest.prototype.open = function(method, url, async, user, pass) {

                    this.addEventListener("readystatechange", function() {

                        var parser = document.createElement('a')
                        parser.href = url;
                        if( parser.hostname == 'sovetnik.market.yandex.ru' ) {
                            this.abort();
                            console.log('KILL YANDEX SOVETNIK!')
                        }

                    }, false);
                    open.call(this, method, url, async, user, pass);
                };
            })(XMLHttpRequest.prototype.open);
        </script>
        <!-- Kill sovetnik --><script>
    <?php endif; ?>
</head>

<body <?php
if (isset($this->params['pageComponent'])) {
    echo ' data-component="' . $this->params['pageComponent'] . '"';
}
?>>
<?php $this->beginBody();
$catalogLabel = 'Каталог';
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GF6P9Q"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

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
                <div class="fl-r hidden-sm">
                    <div class="header-email">
                        <a href="mailto:<?=Yii::getAlias('@mail')?>">
                            <i class="fa fa-envelope corp-col" aria-hidden="true"></i>
                            <span><?=Yii::getAlias('@mail')?></span>
                        </a>
                    </div>
                    <div class="header-phone">
                        <a href="tel:<?= $utmData['phone'] ?>">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span><?= $utmData['phone'] ?></span>
                        </a>
                    </div>
                </div>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="/uslugi/" class="dropdown-toggle" data-toggle="dropdown">
                            Каталог
                            <span class="caret"></span>
                        </a>
                        <ul id="topnav" class="dropdown-menu" style="display: none;">
                            <li><a href="/catalog"><?= $catalogLabel ?></a></li>
                            <li><a href="/catalog/tnvd">Стенды ТНВД</a></li>
                            <li><a href="/catalog/common-rail">Стенды Common Rail</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/blog/">Блог</a>
                    </li>
                    <li>
                        <a href="/delivery/">Доставка и оплата</a>
                    </li><?php /*
                <li>
                    <a href="/contacts/">Видео по работе</a>
                </li>*/?>
                    <li>
                        <a href="/review/">Отзывы</a>
                    </li>
                    <li>
                        <a href="/partners/">Партнерам</a>
                    </li>
                    <li>
                        <a href="/service/">Сервис</a>
                    </li>
                    <li>
                        <a href="/maintenance/">Гарантия</a>
                    </li>
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
        <?php
        $headerLogoClass = $newYearTime ? 'header-logo header-logo_new-year': 'header-logo';
        if(yii::$app->request->pathinfo): ?>
            <?= Html::a('', '/', ['class' => $headerLogoClass]) ?>
        <?php else: ?>
            <?= Html::tag('span', '', ['class' => $headerLogoClass]) ?>
        <?php endif ?>
        <div class="header-text">
            <?= Html::tag('div', 'Стенды ТНВД и Common Rail', ['class' => 'header-title']) ?>
            <?= Html::tag('div', 'Топливное оборудование в наличии и под заказ.', ['class' => 'header-subtitle']) ?>
        </div>
        <div class="header__forms">
            <form class="header-form send">
                <input type="text" placeholder="Телефон" name="phone" class="header-form-phone">
                <?= YII_ENV == 'prod' ? '<input type="hidden" name="target" value="CALLBACK1" />' : '' ?>
                <?php if($utmData['utm']) : ?>
                    <input type="hidden" name="utm" value="<?= $utmData['utm'] ?>" />
                <?php endif; ?>
                <input type="submit" name="submit" class="header-form-submit but-default" value="Жду звонка">
            </form>
            <form class="search-form" action="/search" <?= YII_ENV == 'prod' ? "onsubmit=\"ga('send', 'event', 'SEARCH', '2'); yaCounter24717443.reachGoal('SEARCH'); return true;\"" : ""?>>
                <input type="text" name="query" class="search-form__input" placeholder="Поиск.." value="<?=Yii::$app->getRequest()->getQueryParam('query');?>"/>
                <button type="submit" value="" class="search-form__submit fa fa-search"></button>
            </form>
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
<?php if(YII_ENV == 'prod') : ?>
<!--script type="text/javascript" src="//perezvoni.com/files/widgets/655-45810d447a-0-0d447a-7544dbc734e1bf458-c734e1bf4581.js" charset="UTF-8"></script-->
<script type="text/javascript" src="//cdn.perezvoni.com/widget/js/przv.js?przv_code=1636-cd7fc9fdf15-90f17d74cd7fc9fdf15-fdf15-20074d0a90f1" ></script>
<script src="//callibri.ru/api/module/js/v1/callibri.js" type="text/javascript"></script>
<?php /* <!--Google analytics-->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-69485351-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');


    if (!document.referrer ||
        document.referrer.split('/')[2].indexOf(location.hostname) != 0)
        setTimeout(function(){
            ga('send', 'event', 'Новый посетитель', location.pathname);
        }, 15000);</script>
<!--Google analytics--> */ ?>
<?php /*
<!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию,
по которой можно идентифицировать личность пользователя.
Также запрещается размещать тег на страницах с контентом деликатного характера.
Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
---------------------------------------------------> */?>
<script type="text/javascript">/* <![CDATA[ */
    var google_conversion_id = 849906326;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
/* ]]> */</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/849906326/?guid=ON&amp;script=0"/>
    </div>
</noscript>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = 'vTd4DpcOsM';
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->
    <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?160",t.onload=function(){VK.Retargeting.Init("VK-RTRG-326367-ggWKw"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-326367-ggWKw" style="position:fixed; left:-999px;" alt=""/></noscript>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '703714543357126');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=703714543357126&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
<?php endif; ?>
</body>
</html>
<?php $this->endPage(); ?>
