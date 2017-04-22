<?php
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
                            <a href="<?=$good['detailUrl']?>">
                                <img width="320" height="291"
                                     src="/images/store/<?=$good['mainImage']->filePath;?>"
                                     class="main-block-12psb"/>
                            </a>
                            <?php if($good['available'] == "yes"):?>
                                <div class="main-block-stock">В Наличии</div>
                            <?php else: ?>
                                <div class="main-block-stock">Под заказ</div>
                            <?php endif;?>
                            <div class="main-block-announce-wrap">
                                <div class="main-block-annonce">
                                    <div class="main-block-title"><?=$good['name']?></div>
                                    <div class="main-block-prices">
                                        <?php if($good['price'][0]->price != NULL):?>
                                            <div class="main-block-old-price">
                                                <?=number_format($good['price'][0]->price, 0, "", " ") . " $cur"?>
                                            </div>
                                        <?php endif;?>
                                        <?php if($good['price'][1]->price != NULL):?>
                                            <div class="main-block-new-price tovar__price-bg">
                                                <?=number_format($good['price'][1]->price, 0, '', ' ') . " $cur"?>
                                            </div>
                                        <?php endif;?>
                                    </div>
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