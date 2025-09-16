<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use app\models\SearchForm;
use app\components\Helper;
use yii\widgets\ActiveForm;

/**
 * @var string $content
 */

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
        <?= \common\models\Setting::findOne(['key' => 'code-head', 'is_active' => true])->value ?? ''?>
    <?php endif; ?>
    <?php Helper::getUtmData() ?>
</head>

<body <?php
if (isset($this->params['pageComponent'])) {
    echo ' data-component="' . $this->params['pageComponent'] . '"';
}
?>>
<?php if(YII_ENV == 'prod') : ?>
    <?= \common\models\Setting::findOne(['key' => 'code-body-top', 'is_active' => true])->value ?? ''?>
<?php endif; ?>
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
            <?php $model = new \app\models\PhoneForm(); ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'header-form send2']]) ?>
                <?= $form->field($model, 'phone')->textInput([
                    'placeholder' => 'Телефон',
                    'name' => 'phone',
                    'class' => 'header-form-phone',
                    'template'=>'{input}{error}'
                ])->label(false)->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '+7 (###) ###-##-##',
                    'clientOptions' => [
                        'alias' =>  'phone',
                    ],
                    'options' => [
                        'placeholder' => 'Ваш телефон',
                        'class' => 'header-form-phone'
                    ]
                ]) ?>
                <?= YII_ENV == 'prod' ? '<input type="hidden" name="target" value="CALLBACK1" />' : '' ?>
                <?php if($utmData['utm']) : ?>
                    <input type="hidden" name="utm" value="<?= $utmData['utm'] ?>" />
                <?php endif; ?>
                <input type="submit" name="submit" class="header-form-submit but-default" value="Жду звонка">
            <?php ActiveForm::end() ?>
            <?php
            $this->registerJs(<<<JS
$('.send2').on('beforeSubmit', function(e) {
    let form = $(this);
    form.find("input[name='submit']").attr('disabled', 'disabled');
    
    $.post(
        '/ajax-feedback',
        form.serialize(),
        function (response) {
            if(typeof(response.post.target)!= "undefined" && "yaCounter24717443" in window) {
                yaCounter24717443.reachGoal(response.post.target);
            }
            if (typeof(response.post.target)!= "undefined" && "ga" in window) {
                ga('send', 'event', response.post.target, '2');
            }
            form.find("input[name='submit']").attr('disabled', false);
            form.trigger('reset');
        });
    
    return false;
});

JS, \yii\web\View::POS_END)
            ?>

            <form class="search-form" action="/search" <?= YII_ENV == 'prod' ? "onsubmit=\"if ('ga' in window) { ga('send', 'event', 'SEARCH', '2');} yaCounter24717443.reachGoal('SEARCH'); return true;\"" : ""?>>
                <input type="text" name="query" class="search-form__input" placeholder="Поиск.." value="<?=Yii::$app->getRequest()->getQueryParam('query');?>"/>
                <button type="submit" value="" class="search-form__submit fa fa-search"></button>
            </form>
        </div>
    </div>
</div>
<style>
    .header-form-submit {
        position: absolute;
        right: 0;
        top: 0;
    }
    .header-form .has-error input {
        border: 1px dashed #9a6565;
    }
    .header-form .help-block {
        position: absolute;
        top: -30px;
    }
    .header-form-phone {
        border: none;
        border-bottom: 1px dashed #000;
        top: 1px;
        font-size: 17px;
        background: transparent;
        padding: 5px 5px 0 8px;
    }
</style>
<?php /*
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]) ?>
</div>*/ ?>

<?= Alert::widget() ?>
<?= \frontend\widgets\Plashka::widget()?>
<?= $content ?>

<?=$this->render('/blocks/footer');?>

<?php $this->endBody(); ?>
<?php // if (YII_ENV == 'prod') : ?>
    <?= \common\models\Setting::findOne(['key' => 'code-body-bottom', 'is_active' => true])->value ?? ''?>
<?php // endif; ?>
</body>
</html>
<?php $this->endPage(); ?>
