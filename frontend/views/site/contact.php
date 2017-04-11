<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = "Контакты";
?>
<script src="http://api-maps.yandex.ru/2.0/?load=package.full&amp;lang=ru-RU" type="text/javascript"></script>
<div class="container contacts">
    <h1>Контакты</h1>
    <div class="row">
        <div class="col-md-6">
            <p>ООО "Консул", ОГРН 1155476008643</p>
            <p>ИНН 5407203878 / КПП 540701001</p>
            <div id="YMap"></div>
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
        </div>
        <div class="col-md-6">
            <div class="contacts__manager-wrap">
                <p class="corp-col">
                    Директор
                </p>
                <p>Балабанов Дмитрий Викторович</p>
                <div class="contacts__manager-img">
                    <img src="/i/manager.png"/>
                </div>
            </div>
            <div class="contacts__form-wrap">
                <p class="corp-col">
                    <a href="skype:coswart">coswart</a>
                </p>
                <p class="corp-col">
                    <a href="mailto:info@12psb.ru">info@12psb.ru</a>
                </p>
                <form>
                    <textarea placeholder="Есть вопросы по покупке стендов ТНВД и Common Rail? Я оперативно отвечу на них! Напишите Ваш вопрос здесь"></textarea>
                    <input type="text" name="phone" placeholder="Ваш телефон" />
                    <input type="submit" value="Связаться со мной" />
                </form>
            </div>
        </div>
    </div>
</div>
