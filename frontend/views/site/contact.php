<?php
use app\components\Helper;
use yii\widgets\Breadcrumbs;

$title = 'Контакты';
$this->params['breadcrumbs'][] = $title;
$this->title = $title;
$this->registerMetaTag(['name' => 'description', 'content' => 'Контакты 12PSB.RU: ООО "Консул", пр-т Дзержинского, 1/1 офис 71']);
$this->registerMetaTag(['og:title' => $title]);
$utmData = Helper::getUtmData();
$currentCity = \common\models\Contact::findOne([
    'active' => 'yes',
    'code' => yii::$app->params['city']['code']
])
?>
<script src="//api-maps.yandex.ru/2.0/?load=package.full&amp;lang=ru-RU" type="text/javascript"></script>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<div class="container contacts content">
    <h1>Контакты</h1>
    <div class="row">
        <div class="col-md-6">
            <p>ООО "Консул", ОГРН 1155476008643</p>
            <p>ИНН 5407203878 / КПП 540701001</p>
            <div class="YMapWrap border-emul">
                <div id="YMap">
                    <div class="ymaps-block-address">
                        <?php if(yii::$app->params['city']['code'] == 'nsk'): ?>
                        <span class="corp-col">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <i>Главный офис:</i>
                        </span>
                        <?php endif ?>
                        <?= $currentCity and !empty($currentCity->city) ? $currentCity->city . ', ' : '' ?>

                        <?= $currentCity and !empty($currentCity->address) ? $currentCity->address : '' ?>
                    </div>
                </div>
            </div>
            <script>
                function init () {
                    var myMap = new ymaps.Map(
                        "YMap",
                        {
                            center: [55.04329723164, 82.949294433604],
                            zoom: 16,
                        }
                    );
                    myMap.controls.add('zoomControl');//.add('typeSelector').add('mapTools');
                    myPlacemark = new ymaps.Placemark([55.04329723164, 82.949294433604]);
                    myMap.geoObjects.add(myPlacemark);
                }
                ymaps.ready(init);
            </script>
            <div class="contacts__phones">
                <div class="contacts__phones-free">
                    <p><b>Бесплатный номер:</b></p>
                    <i class="fa fa-phone corp-col" aria-hidden="true"></i>
                    <span>
                        <a href="tel:<?= $utmData['phone'] ?>">
                            <?= $utmData['phone'] ?>
                        </a>
                    </span>
                </div>
                <div class="contacts__phones-city">
                    <p><b>Телефон городе <?= yii::$app->params['city']['name'] ?>:</b></p>
                    <?php if($currentCity): ?>
                        <div><a href="tel:<?= $currentCity->phone ?>"><?= $currentCity->phone ?></a></div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="contacts__manager-wrap">
                <p class="corp-col">Директор</p>
                <p>Балабанов Дмитрий Викторович</p>
                <img src="/i/manager.jpg" class="contacts__manager-img border-emul"/>
            </div>
            <div class="contacts__form-wrap">
                <p><a href="skype:coswart">
                    <i class="fa fa-skype corp-col" aria-hidden="true"></i>
                    <span>coswart</span>
                </a>
                <a href="mailto:<?=Yii::getAlias('@mail')?>" class="contacts__email">
                    <i class="fa fa-envelope corp-col" aria-hidden="true"></i>
                    <span><?=Yii::getAlias('@mail')?></span>
                </a></p>
                <div class="form-wrapper">
                    <form class="send contacts__form" <?= YII_ENV == 'prod' ? "onsubmit=\"yaCounter24717443.reachGoal('SEARCH'); return true;\"" : ""?>>
                        <div class="border-emul mb-15">
                            <textarea name="mess" class="contacts__form-ta"
                                      placeholder="Есть вопросы по покупке стендов ТНВД и Common Rail? Я оперативно отвечу на них! Напишите Ваш вопрос здесь"></textarea>
                        </div>
                        <div class="border-emul mb-15">
                            <input type="text" name="phone" placeholder="Ваш телефон" />
                        </div>
                        <?= YII_ENV == 'prod' ? '<input type="hidden" name="target" value="CONTACTS" />' : '' ?>
                        <?php if($utmData['utm']) : ?>
                            <input type="hidden" name="utm" value="<?= $utmData['utm'] ?>" />
                        <?php endif; ?>
                        <div class="border-emul clearfix">
                            <input type="submit" name="submit" value="Связаться со мной" class="but-default contacts__form-submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
