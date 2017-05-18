<?php
    function hidetab($val) {
        return trim($val) == "" ? 'class="hidden"' : '';
    }


use pistol88\shop\models\Image as ImagePistol;
use pistol88\shop\models\Price;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\widgets\Breadcrumbs;

$images     = ImagePistol::find()->where(['itemid' => $product->id, 'isMain' => null])->all();

$mainImg = null;
if($mainImage = ImagePistol::find()->where(['itemid' => $product->id, 'isMain' => 1])->one())
    $mainImg[]  = $mainImage;

$images     = $mainImg ? array_merge($mainImg, $images) : $images;

$priceArr   = Price::find()->where(['product_id' => $product->id])->all();

$price      = number_format($priceArr[0]->price, 0, "", " ");
$priceOld   = number_format($priceArr[0]->price_old, 0, "", " ");

foreach($breadcrumbs as $breadcrumb):
    $this->params['breadcrumbs'][] = ['label' => $breadcrumb['name'], 'url' => ['/'. $breadcrumb['link']]];
endforeach;
$this->params['breadcrumbs'][] = $product->name;?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>

<div class="container article">
    <div class="tovar__main">
        <div class="tovar__gallery-wrap">
            <div class="tovar__head-xsv">
                <h1 class="title"><?=$product->name?></h1>
                <div class="tovar__prices">
                    <?php if($priceArr[0]->price_old):?>
                        <div class="fl-l tovar__price-old gray-bg">
                            <div class="crossing">
                                <?=$priceOld . Yii::getAlias('@cur')?>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="tovar__price tovar__price-bg">
                        <?=$price . Yii::getAlias('@cur')?>
                    </div>
                </div>
            </div>
            <div class="tovar__gallery owl-carousel owl-theme">
                <?php foreach($images as $image){?>
                    <div class="tovar__gallery-item"><?php
                        $width = 500;
                        $height = $width * 3 / 4;
                        $imagePath = $image->filePath;
                        $path = explode('/', $imagePath);
                        $filename = $width.'x'.$height . '-' . array_pop($path);
                        $pathToImg = implode('/', $path);

                        if(!file_exists(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename)) {
                            Image::getImagine()->open(Yii::getAlias('@webroot/images/store/') . $imagePath)->
                                thumbnail(new Box($width, $height))->
                                save(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename, ['quality' => 100]);
                        }?>
                        <img src="<?='/images/cache/' . $pathToImg . '/' . $filename?>" />
                    </div>
                <?php }?>
            </div>
        </div>

        <div class="tovar__info">
            <div class="tovar__head tovar__head-xsh clearfix">
                <h1 class="title"><?=$product->name?></h1>
                <div class="tovar__prices">
                    <?php if($priceArr[0]->price_old):?>
                        <div class="fl-l tovar__price-old gray-bg">
                            <div class="crossing">
                                <?=$priceOld . Yii::getAlias('@cur')?>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="tovar__price tovar__price-bg">
                        <?=$price . Yii::getAlias('@cur')?>
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
                    <a href="/zakaz?name=<?=str_replace(' ', '%20', $product->code)?>" class="fancybox fancybox.ajax">Заказать</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="metal-bg article">
    <div class="light-block-separator"></div>
    <div class="container">
        <div class="article__left-col">
            <!-- Навигация -->
            <ul class="nav nav-tabs" role="tablist">
                <li <?=hidetab($product->text)?> class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Описание</a></li>
                <li <?=hidetab($product->getField('video'))?>>
                    <a role="button" href="#video" aria-controls="video" role="tab" data-toggle="tab">Видео</a>
                </li>
                <li <?=hidetab($product->characteristics)?>><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Характеристики</a></li>
                <li <?=hidetab(trim($product->photo))?>><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Интерфейс</a></li>
                <li <?=hidetab(trim($product->equipment))?>><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Комплектация</a></li>
                <li <?=hidetab(trim($product->extra))?>><a href="#extra" aria-controls="extra" role="tab" data-toggle="tab">Доп. опции</a></li>
            </ul>
            <!-- Содержимое вкладок -->
            <div class="tab-content content">
                <div role="tabpanel" class="tab-pane active" id="home"><?=$product->text?></div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <?=$product->characteristics;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <?=$product->photo;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <?=$product->equipment;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="extra">
                    <?=$product->extra;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="video"><?php
                    if(!trim($product->getField('video')) == "") {
                        foreach (explode(',', $product->getField('video')) as $link) {
                            $link = explode("watch?v=", $link)[1]; ?>
                            <iframe width="391" height="238" src="https://www.youtube.com/embed/<?= $link ?>"
                                    frameborder="0" allowfullscreen></iframe>
                        <?php }
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
                <form class="feedback__form send">
                    <textarea name="message" class="feedback__border feedback__textarea" placeholder="Есть вопросы по покупке стендов ТНВД и Common Rail? Я оперативно отвечу на них! Напишите Ваш вопрос здесь"></textarea>
                    <input name="phone" class="feedback__border feedback__input" placeholder="Ваш телефон" />
                    <input name="submit" type="submit" class="but-default feedback__submit" value="Связаться со мной"/>
                </form>
            </div>
        </div>
    </div>
</div>