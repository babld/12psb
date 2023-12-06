<?php
$this->params['pageComponent'] = 'product';
function hidetab($val) {
    return trim($val) == "" ? 'class="hidden"' : '';
}
use pistol88\shop\models\Image as ImagePistol;
use pistol88\shop\models\Price;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\widgets\Breadcrumbs;
use app\components\Helper;
use common\models\ProductReview;

/**
 * @var \pistol88\shop\models\Product $product
 */

$reviews    = ProductReview::findAll(['item_id' => $product->id, 'is_active' => 'yes']);

$images     = ImagePistol::find()->where(['itemid' => $product->id, 'isMain' => null])->all();

$mainImg    = null;
if($mainImage = ImagePistol::find()->where(['itemid' => $product->id, 'isMain' => 1])->one())
    $mainImg[]  = $mainImage;

$images     = $mainImg ? array_merge($mainImg, $images) : $images;

$priceArr   = Price::find()->where(['product_id' => $product->id])->all();

$price      = number_format($priceArr[0]->price, 0, "", " ");
$priceOld   = number_format($priceArr[0]->price_old, 0, "", " ");

foreach($breadcrumbs as $breadcrumb):
    $this->params['breadcrumbs'][] = ['label' => $breadcrumb['name'], 'url' => ['/'. $breadcrumb['link']]];
endforeach;

$title = Helper::textHandl($product->name);
$this->params['breadcrumbs'][] = $title;
$this->title = !empty($product->seo->title) ? Helper::textHandl($product->seo->title) : $title;
$this->registerMetaTag(['name' => 'description', 'content' => Helper::textHandl($product->seo->description)]);
$this->registerMetaTag(['og:title' => $this->title]);
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>

<div class="container article">
    <div class="tovar__main" itemscope itemtype="http://schema.org/Product">
        <div class="tovar__head tovar__head-xsh clearfix">
            <div class="tovar__prices">
                <?php if($priceArr[0]->price_old):?>
                    <div class="fl-l tovar__price-old gray-bg">
                        <div class="crossing">
                            <span><?=$priceOld . Yii::getAlias('@cur')?></span>
                        </div>
                    </div>
                <?php endif;?>
                <div class="tovar__price tovar__price-bg">
                    <span itemprop="price"><?= $price ?></span>
                    <span itemprop="priceCurrency"><?= Yii::getAlias('@cur')?></span>
                </div>
            </div>
            <h1 class="title" itemprop="name"><?= Helper::textHandl($product->name) ?></h1>
        </div>

        <div class="tovar__gallery-wrap">
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
                        <img itemprop="image" data-src="<?='/images/cache/' . $pathToImg . '/' . $filename?>" class="owl-lazy"/>
                        <i class="product-stock"><?= ($product->available == "yes") ? "В Наличии" : "Под заказ" ?></i>
                    </div>
                <?php }?>
            </div>
        </div>

        <div class="tovar__text" itemprop="description">
            <?= Helper::textHandl($product->short_text) ?>
            <br><br>
            <div class="tovar__controls">
                <a href="/service">
                    <img src="/images/st-ic-rassrochka.png"/>
                    Сервис
                </a>
                <a href="/maintenance">
                    <img src="/images/st-ic-garantiya.png"/>
                    Гарантия
                </a>
                <div class="clear"></div>
                <div class="but-default tovar__order">
                    <a href="/zakaz?name=<?=str_replace(' ', '%20', $product->code)?>" class="fancybox fancybox.ajax">Заказать</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gray-block-bg article article_padding-top">
    <?php #<div class="light-block-separator"></div> ?>
    <div class="container">
        <div class="article__left-col">
            <!-- Навигация -->
            <ul class="nav nav-tabs" role="tablist">
                <li <?=hidetab($product->text)?> class="active">
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Описание</a>
                </li>
                <?php if((!trim($product->getField('video')) == "") && (@explode(',', $product->getField('video'))[1])):?>
                <li <?=hidetab($product->getField('video'))?>>
                    <a role="button" href="#video" aria-controls="video" role="tab" data-toggle="tab">
                        Видео
                        <span class="article__notification"><?= count(explode(',', $product->getField('video'))) ?></span>
                    </a>
                </li>
                <?php endif ?>
                <li <?=hidetab($product->characteristics)?>><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Характеристики</a></li>
                <li <?=hidetab(trim($product->photo))?>><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Интерфейс</a></li>
                <li <?=hidetab(trim($product->equipment))?>><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Комплектация</a></li>
                <li <?=hidetab(trim($product->extra))?>><a href="#extra" aria-controls="extra" role="tab" data-toggle="tab">Доп. опции</a></li>
                <li>
                    <a href="#review" aria-controls="review" role="tab" data-toggle="tab">
                        Отзывы
                        <span class="article__notification"><?= !empty($reviews) ? count($reviews) : 'new' ?></span>
                    </a>
                </li>
            </ul>
            <!-- Содержимое вкладок -->
            <div class="tab-content content">
                <div role="tabpanel" class="tab-pane active" id="home"><?= Helper::textHandl($product->text) ?></div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <?= Helper::textHandl($product->characteristics) ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <?= Helper::textHandl($product->photo) ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <?= Helper::textHandl($product->equipment) ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="extra">
                    <?= Helper::textHandl($product->extra) ?>
                </div>
                <?php /* if((!trim($product->getField('video')) == "") && (@explode(',', $product->getField('video'))[1])):?>
                    <div role="tabpanel" class="tab-pane" id="video">
                        <?php foreach (explode(',', $product->getField('video')) as $link) :?>
                            <?php $link = explode("watch?v=", $link)[1]; ?>
                            <div class="video-responsive">
                                <iframe width="391" height="238" src="https://www.youtube.com/embed/<?= $link ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                        <?php endforeach?>
                    </div>
                <?php endif */?>
                <div role="tabpane" class="tab-pane" id="review">
                    <div class="article__review">
                        <?php if(!empty($reviews)): ?>
                            <div class="article__review-items">
                                <h4>Отзывы о данном стенде:</h4>
                            <?php
                            foreach($reviews as $review) : ?>
                                <div class="article__review-item">
                                    <b><i><?= $review->name ?></i></b>
                                    <p><?= $review->message ?></p>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <h4>На данный момент нет отзывов о данном продукте. Будьте первым!</h4>
                        <?php endif; ?>
                        <?= $this->render('/blocks/review-form', ['product' => $product]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="article__right-col">
            <div class="feedback form-wrapper">
                <div class="feedback__manager feedback__border">
                    <?php /*<div class="feedback__manager-head">
                        <div class="feedback__manager-rang">Директор</div>
                        <div class="feedback__manager-name">Балабанов Дмитрий Викторович</div>
                    </div> */ ?>
                    <img src="/i/manager.jpg" class="feedback__manager-img" />
                </div>
                <?= $this->render('@frontend/views/blocks/feedback-form.php') ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var google_tag_params = {
        ecomm_prodid: '<?=$product->id?>',
        ecomm_pagetype: 'product',
        ecomm_totalvalue: '<?=number_format($product->price, 0, '', '')?>',
    };
</script>