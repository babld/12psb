<div class="main-block">
    <div class="container">
        <h3 class="block-title">Акционные предложения</h3>
        <div class="main-block-slider-wrap">
            <div class="main-block-slider owl-carousel owl-theme">
                <?php foreach($goods as $good) :
                    if($good['is_promo'] == "yes"):?>
                        <div class="main-block-slider-item">
                            <a href="<?=$good['detailUrl']?>">
                                <img width="348" height="309"
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
                                            <div class="main-block-old-price"><?=$good['price'][0]->price?></div>
                                        <?php endif;?>
                                        <?php if($good['price'][1]->price != NULL):?>
                                            <div class="main-block-new-price"><?=$good['price'][1]->price?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="main-block-desc">
                                        <p><?=$good['short_text']?></p>
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