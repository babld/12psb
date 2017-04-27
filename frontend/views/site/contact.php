<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = "Контакты";
?>
<script src="http://api-maps.yandex.ru/2.0/?load=package.full&amp;lang=ru-RU" type="text/javascript"></script>
<div class="container contacts content">
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb">Главная</a>
        <span class="breadcrumb">Контакты</span>
    </div>

    <h1>Контакты</h1>
    <div class="row">
        <div class="col-md-6">
            <div>ООО "Консул", ОГРН 1155476008643</div>
            <div>ИНН 5407203878 / КПП 540701001</div>
            <div class="YMapWrap border-emul">
                <div id="YMap"></div>
            </div>
            <script>
                function init () {
                    var myMap = new ymaps.Map(
                        "YMap",
                        {
                            center: [55.793353332847,37.591329961971],
                            zoom: 16,
                        }
                    );
                    myMap.controls.add('zoomControl');//.add('typeSelector').add('mapTools');
                    myPlacemark = new ymaps.Placemark([55.793353332847,37.591329961971]);
                    myMap.geoObjects.add(myPlacemark);
                }
                ymaps.ready(init);
            </script>
            <div class="contacts__phones">
                <div class="contacts__phones-free">
                    <p><b>Бесплатный номер:</b></p>
                    <i class="fa fa-phone corp-col" aria-hidden="true"></i>
                    <span>8-800-775-6758</span>
                </div>
                <div class="contacts__phones-city">
                    <p><b>Телефоны в городах:</b></p>
                    <div>Новосибирск: 8-383-207-8860</div>
                    <div>Москва: 8-499-346-6799</div>
                    <div>Санкт-Петербург: 8-812-424-3313</div>
                    <div>Екатеринбург: 8-343-345-6532</div>
                    <div>Омск: 8-381-297-2030</div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="corp-col">Директор</div>
            <div class="contacts__manager-wrap">
                <div>Балабанов Дмитрий Викторович</div>

                <img src="/i/manager.png" class="contacts__manager-img border-emul"/>

            </div>
            <div class="contacts__form-wrap">
                <a href="skype:coswart">
                    <i class="fa fa-skype corp-col" aria-hidden="true"></i>
                    <span>coswart</span>
                </a>
                <a href="mailto:info@12psb.ru" class="contacts__email">
                    <i class="fa fa-envelope corp-col" aria-hidden="true"></i>
                    <span>info@12psb.ru</span>
                </a>
                <form class="send contacts__form">
                    <div class="border-emul mb-10">
                        <textarea class="contacts__form-ta"
                                  placeholder="Есть вопросы по покупке стендов ТНВД и Common Rail? Я оперативно отвечу на них! Напишите Ваш вопрос здесь"></textarea>
                    </div>
                    <div class="border-emul  mb-10">
                        <input type="text" name="phone" placeholder="Ваш телефон" />
                    </div>
                    <div class="border-emul clearfix">
                        <input type="submit" value="Связаться со мной" class="but-default" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
