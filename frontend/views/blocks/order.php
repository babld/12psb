<?php
$cur = " р.";
?>
<div class="order">
    <div class="container">
        <div class="order-head">
            Популярные модели топливного оборудования
        </div>
        <?php /*<div class="order-stends-title">Стенды для тестирования отечественных и импортных ТНВД</div>*/ ?>
        <div class="w-clear order-stend-list owl-carousel owl-theme">
            <?php foreach($goods as $good):
                if($good['is_popular'] == "yes"):?>
                    <div class="order-stend">
                        <div class="tovar__prices">
                            <?php if($good['price'][0]->price != NULL):?>
                                <div class="fl-l tovar__price-old gray-bg">
                                    <div class="crossing">
                                        <?=number_format($good['price'][0]->price_old, 0, "", " ") . $cur?>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if($good['price'][0]->price != NULL):?>
                                <div class="tovar__price tovar__price-bg">
                                    <?=number_format($good['price'][0]->price, 0, "", " ") . $cur?>
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="order-image-wrap">
                            <a href="<?=$good['detailUrl']?>">
                                <img src="/images/store/<?=$good['mainImage']->filePath?>" class="order-stend-image"/>
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

       <div class="order-notice">
           А также любые стенды для тестирования Common Rail и ТНВД
           <a href="zakaz" class="fancybox fancybox.ajax">с фабрики под заказ!</a>
        </div>
    </div>
    <div class="order-bottom"></div>

</div>