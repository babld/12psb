<?php
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

$cur = "р.";
?>
<div class="gray-block-bg">
    <div class="main-block">
        <h3 class="block-title">Акционные предложения</h3>
        <div class="main-block-slider-wrap">
            <div class="main-block-slider owl-carousel owl-theme">
                <?php foreach($goods as $good) :
                    if($good['is_promo'] == "yes"):?>
                        <div class="main-block-slider-item">
                            <a href="<?=$good['detailUrl']?>" class="main-block__imglink"><?php
                                $width = 320;
                                $height = $width * 3 / 4;
                                $imagePath = $good['mainImage']->filePath;
                                $path = explode('/', $imagePath);
                                $filename = $width.'x'.$height . '-' . array_pop($path);
                                $pathToImg = implode('/', $path);
                                if(!file_exists(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename)) {
                                    Image::getImagine()->open(Yii::getAlias('@webroot/images/store/') . $imagePath)->
                                        thumbnail(new Box($width, $height))->
                                        save(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename, ['quality' => 90]);
                                }?>
                                <img src="<?='/images/cache/' . $pathToImg . '/' . $filename?>"
                                     class="main-block-12psb"/>
                                <?php if($good['available'] == "yes"):?>
                                    <i class="main-block-stock">В Наличии</i>
                                <?php else:?>
                                    <i class="main-block-stock">Под заказ</i>
                                <?php endif?>
                            </a>

                            <div class="main-block-announce-wrap">
                                <div class="main-block-annonce">
                                    <div class="main-block-prices">
                                        <?php if($good['price'][0]->price_old != NULL):?>
                                            <div class="main-block-old-price">
                                                <?=number_format($good['price'][0]->price_old, 0, "", " ") . " $cur"?>
                                            </div>
                                        <?php endif;?>
                                        <?php if($good['price'][0]->price != NULL):?>
                                            <div class="main-block-new-price tovar__price-bg">
                                                <?=number_format($good['price'][0]->price, 0, '', ' ') . " $cur"?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="main-block-title"><?=$good['name']?></div>
                                    <div class="main-block-desc">
                                        <p><?=$good['short_text']?></p>
                                    </div>
                                    <div class="clearfix">
                                        <a href="<?=$good['detailUrl']?>" class="main-block__link but-default">Подробнее...</a>
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