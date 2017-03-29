<?php
use pistol88\shop\models\Image;
use pistol88\shop\models\Price;
?>
<div class="main-block">
    <div class="container">
        <h3 class="block-title">Акционные предложения</h3>
        <div class="layout-width main-block-slider-wrap">
            <div class="main-block-slider">
                <?php foreach($goods as $good) :
                    if($good->is_promo == "yes"):?>
                        <div class="main-block-slider-item">
                            <?php
                            $image = Image::find()->where(['itemid' => $good->id])->one();
                            $price = Price::find()->where(['product_id' => $good->id])->all();?>
                            <a href="/view?id=<?=$good->id?>">
                                <img width="348" height="309" src="/images/store/<?=$image->filePath?>" class="main-block-12psb"/>
                            </a>
                            <?php if($good->available == "yes"):?>
                                <div class="main-block-stock">В Наличии</div>
                            <?php else: ?>
                                <div class="main-block-stock">Под заказ</div>
                            <?php endif;?>
                            <div class="main-block-announce-wrap">
                                <div class="main-block-annonce">
                                    <div class="main-block-title"><?=$good->name?></div>
                                    <div class="main-block-prices">
                                        <?php if($price[0]->price != NULL):?>
                                            <div class="main-block-old-price"><?=$price[0]->price?></div>
                                        <?php endif;?>
                                        <?php if($price[1]->price != NULL):?>
                                            <div class="main-block-new-price"><?=$price[1]->price?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="main-block-desc">
                                        <p>
                                            <?=$good->text?>
                                        </p>
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