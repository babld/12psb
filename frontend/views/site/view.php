<?php
  /*
  $w_o и h_o - ширина и высота выходного изображения
  */
  function resize($image, $w_o = false, $h_o = false) {

      if (($w_o < 0) || ($h_o < 0)) {
          echo "Некорректные входные параметры";
          return false;
      }
      list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)

      $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
      $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
      if ($ext) {
          $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
          $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
      } else {
          echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
          return false;
      }
      /* Если указать только 1 параметр, то второй подстроится пропорционально */
      if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
      if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
      $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
      imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
      $func = 'image'.$ext; // Получаем функция для сохранения результата
      return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
  }
  /* Вызываем функцию с целью уменьшить изображение до ширины в 100 пикселей, а высоту уменьшив пропорционально, чтобы не искажать изображение */
  #resize("image.jpg", 100); // Вызываем функцию

use pistol88\shop\models\Image;
use pistol88\shop\models\Price;
$cur = 'р.';

$product = $model::findOne($id);

$images     = Image::find()->where(['itemid' => $product->id])->all();
$priceArr   = Price::find()->where(['product_id' => $product->id])->all();

$price      = number_format($priceArr[0]->price, 0, "", " ");
$priceOld   = number_format($priceArr[0]->price_old, 0, "", " ");

?>
<div class="container article">
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb">Главная</a>
        <a href="/stanki-i-oborudovanie" class="breadcrumb">Каталог</a>
        <span class="breadcrumb"><?=$product->name?></span>
    </div>

    <div class="tovar__main">
        <div class="tovar__gallery-wrap">
            <div class="tovar__gallery owl-carousel owl-theme">
                <?php foreach($images as $image){?>
                    <div class="tovar__gallery-item">
                        <?php resize('images/store/' . $image->filePath, 550, 500); // Вызываем функцию?>
                        <img src="/images/store/<?=$image->filePath?>"/>
                    </div>
                <?php }?>
            </div>
        </div>

        <div class="tovar__info">
            <div class="tovar__head clearfix">
                <h1><?=$product->name?></h1>
                <div class="tovar__prices">
                    <div class="fl-l tovar__price-old gray-bg">
                        <div class="crossing">
                            <?=$priceOld . ' ' . $cur?>
                        </div>
                    </div>
                    <div class="tovar__price">
                        <?=$price . ' ' . $cur?>
                    </div>
                </div>
            </div>
            <div class="tovar__text"><?=$product->short_text?></div>
            <div class="tovar__controls">
                <?php /*<div class="tovar_discount fl-l">
                    <a href="#">Купить дешевле</a>
                </div>
                <div class="tovar__calc fl-l">
                    <a href="#">Рассчитать доставку</a>
                </div>*/ ?>
                <div class="but-default tovar__order">
                    <a href="#">Заказать</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="metal-bg">
    <div class="light-block-separator"></div>
    <div class="container">
        <div class="article__left-col">
            <!-- Навигация -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Описание</a></li>
                <li><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Характеристики</a></li>
                <li><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Интерфейс</a></li>
                <li><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Комплектация</a></li>
                <li><a href="#extra" aria-controls="settings" role="tab" data-toggle="tab">Дополнительные опции</a></li>
            </ul>
            <!-- Содержимое вкладок -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home"><?=$product->text?></div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <?=$product->characteristics;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <img src="<?=$product->photo?>">
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <?=$product->equipment;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="extra">
                    <?php foreach($model->getFields() as $item) {
                        echo $item->name . ' ' . $model->getField($item->slug) . "<br/>";
                    }?>
                </div>
            </div>
        </div>
        <div class="article__right-col">
            <div class="feedback form-wrapper">
                <div class="feedback__manager feedback__border">
                    <div class="feedback__manager-head">
                        <div class="feedback__manager-rang">Директор</div>
                        <div class="feedback__manager-name">Балабанов Дмитрий Викторович</div>
                    </div>
                    <img src="/i/manager.png" class="feedback__manager-img" />
                </div>
                <form class="feedback__form">
                    <textarea name="message" class="feedback__border feedback__textarea" placeholder="Есть вопросы по покупке стендов ТНВД и Common Rail? Я оперативно отвечу на них! Напишите Ваш вопрос здесь"></textarea>
                    <input name="phone" class="feedback__border feedback__input" placeholder="Ваш телефон" />
                    <input name="submit" type="submit" class="but-default feedback__submit" value="Связаться со мной"/>
                </form>
            </div>
        </div>
    </div>
</div>