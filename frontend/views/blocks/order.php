<?php
use pistol88\shop\models\Image;
use pistol88\shop\models\Price;
?>
<div class="order">
    <div class="order-head-bg" id="2"></div>
    <div class="container">
        <div class="order-head">
            Популярные модели топливного оборудования
        </div>
        <?php /*<div class="order-stends-title">Стенды для тестирования отечественных и импортных ТНВД</div>*/ ?>
        <ul class="w-clear order-stend-list owl-carousel owl-theme">
            <?php foreach($goods as $good):
                $image = Image::find()->where(['itemid' => $good->id])->one();
                $price = Price::find()->where(['product_id' => $good->id])->all();
                if($good->is_popular == "yes"):?>
                    <li class="order-stend">
                        <?php if($price[0]->price != NULL):?>
                            <div class="order-stend-birk"><?=$price[0]->price?></div>
                        <?php endif;?>

                        <div class="order-image-wrap">
                            <a href="/view?id=<?=$good->id?>">
                                <img src="/images/store/<?=$image->filePath?>" class="order-stend-image"/>
                            </a>
                            <div class="order-stend-title"><?=$good->name?></div>
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