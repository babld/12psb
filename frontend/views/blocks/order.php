<?php
use yii\imagine\Image;
use Imagine\Image\Box;
?>
<div class="order">
    <div class="container">
        <div class="order-head">
            Популярные модели топливного оборудования
        </div>
        <?php /*<div class="order-stends-title">Стенды для тестирования отечественных и импортных ТНВД</div>*/ ?>
        <div class="order-stend-list owl-carousel owl-theme">
            <?php foreach($goods as $good):
                if($good['is_popular'] == "yes"):?>
                    <div class="order-stend">
                        <div class="tovar__prices">
                            <?php if($good['price'][0]->price_old != NULL):?>
                                <div class="fl-l tovar__price-old gray-bg">
                                    <div class="crossing">
                                        <?=number_format($good['price'][0]->price_old, 0, "", " ") . Yii::getAlias('@cur')?>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if($good['price'][0]->price != NULL):?>
                                <div class="tovar__price tovar__price-bg">
                                    <?=number_format($good['price'][0]->price, 0, "", " ") . Yii::getAlias('@cur')?>
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="order-image-wrap">
                            <a href="<?=$good['detailUrl']?>"><?php
                                $width = 264;
                                $height = 240;
                                $imagePath = $good['mainImage']->filePath;
                                $path = explode('/', $imagePath);
                                $filename = $width.'x'.$height . '-thumb-' . array_pop($path);
                                $pathToImg = implode('/', $path);
                                if(!file_exists(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename)) {
                                    Image::thumbnail(Yii::getAlias('@webroot/images/store/') . $imagePath, $width, $height)
                                        ->save(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename, ['quality' => 80]);


                                }?>
                                <img src="<?='/images/cache/' . $pathToImg . '/' . $filename?>" class="order-stend-image"/>
                            </a>
                            <div class="order-stend-title"><?=$good['name']?></div>
                        </div>
                        <a href="<?=$good['detailUrl']?>" class="order-stend__button but-default">
                            Подробнее
                        </a>
                    </div>
                <?php endif;
            endforeach;?>
        </div>
    </div>
    <div class="order-bottom"></div>

</div>