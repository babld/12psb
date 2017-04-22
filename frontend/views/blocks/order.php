<div class="order">
    <div class="container">
        <div class="order-head">
            Популярные модели топливного оборудования
        </div>
        <?php /*<div class="order-stends-title">Стенды для тестирования отечественных и импортных ТНВД</div>*/ ?>
        <ul class="w-clear order-stend-list owl-carousel owl-theme">
            <?php foreach($goods as $good):
                if($good['is_popular'] == "yes"):?>
                    <li class="order-stend">
                        <?php if($good['price'][0]->price != NULL):?>
                            <div class="order-stend-birk"><?=$good['price'][0]->price?></div>
                        <?php endif;?>

                        <div class="order-image-wrap">
                            <a href="<?=$good['detailUrl']?>">
                                <img src="/images/store/<?=$good['mainImage']->filePath?>" class="order-stend-image"/>
                            </a>
                            <div class="order-stend-title"><?=$good['name']?></div>
                        </div>

                        <div class="block-buts">
                            <a class="order-but fancybox fancybox.ajax" href="zakaz?model=12PSDW">Подробнее</a>
                        </div>
                    </li>
            <?php endif;
            endforeach;?>
        </ul>

       <div class="order-notice">А также любые стенды для тестирования Common Rail и ТНВД
            <a href="zakaz" class="fancybox fancybox.ajax">с фабрики под заказ!</a>
        </div>
    </div>
    <div class="order-bottom"></div>

</div>