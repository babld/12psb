<?php
use app\components\Helper;
use Yii;

$cur = "р.";
?>
<div class="gray-block-bg">
    <div class="main-block">
        <h3 class="block-title">Акционные предложения</h3>
        <div class="main-block-slider-wrap">
            <div class="main-block-slider owl-carousel owl-theme">
                <?php foreach($products as $product) :
                    if($product->is_promo == "yes"):
                        $productUrl = $product->category->getUrl() . '/' . $product->slug;?>
                        <div class="main-block-slider-item">
                            <a href="<?= $productUrl ?>" class="main-block__imglink"><?php
                                $width = 320;
                                $height = (int) ($width * 3 / 4);
                                $imagePath = $product->image->filePath;
                                $original = Yii::getAlias('@webroot/images/store/') . $imagePath;
                                $fallback = is_file($original) ? null : Yii::getAlias(Yii::$app->getModule('gallery')->placeHolderPath);
                                $imgUrl = Yii::$app->imageCache->getThumbnailUrl($imagePath, $width, $height, [
                                    'quality' => 90,
                                    'fallbackSource' => $fallback,
                                ]);
                                ?>
                                <img src="<?= $imgUrl ?>"
                                     class="main-block-12psb"/>
                                <i class="product-stock">
                                    <?= ($product->available == "yes") ? "В Наличии" : "Под заказ" ?>
                                </i>
                            </a>

                            <div class="main-block-announce-wrap">
                                <div class="main-block-annonce">
                                    <div class="main-block-prices">
                                        <?php if($product->oldPrice != NULL):?>
                                            <div class="main-block-old-price">
                                                <?= number_format($product->oldPrice, 0, "", " ") . " $cur"?>
                                            </div>
                                        <?php endif ?>
                                        <?php if($product->price != NULL):?>
                                            <div class="main-block-new-price tovar__price-bg">
                                                <?=number_format($product->price, 0, '', ' ') . " $cur"?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="main-block-title"><?= Helper::textHandl($product->name) ?></div>
                                    <div class="main-block-desc">
                                        <p><?= Helper::textHandl($product->short_text) ?></p>
                                    </div>
                                    <div class="clearfix">
                                        <a href="<?= $productUrl ?>" class="main-block__link but-default">Подробнее...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <div class="main-block-slider-pagination"></div>
        </div>
    </div>
</div>