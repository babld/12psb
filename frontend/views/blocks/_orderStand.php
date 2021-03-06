<?php
use pistol88\shop\models\Category;
?>
<div class="order-stend">
    <div class="tovar__prices">
        <?php if($good->oldPrice != NULL):?>
            <div class="fl-l tovar__price-old gray-bg">
                <div class="crossing">
                    <?= number_format($good->oldPrice, 0, "", " ") . Yii::getAlias('@cur')?>
                </div>
            </div>
        <?php endif;?>
        <?php if($good->price != NULL):?>
            <div class="tovar__price tovar__price-bg">
                <?= number_format($good->price, 0, "", " ") . Yii::getAlias('@cur')?>
            </div>
        <?php endif;?>
    </div>
    <?php $url = Category::findOne($good->category->id)->getUrl() . '/' .$good->slug; ?>
    <div class="order-image-wrap">
        <a href="<?= $url ?>">
            <img class="owl-lazy" data-src="<?= $good->image->getUrl('264x240') ?>" class="order-stend-image"/>
            <i class="product-stock"><?= ($good['available'] == "yes") ? "В Наличии" : "Под заказ" ?></i>
        </a>
        <div class="order-stend-title"><?= $good['name'] ?></div>
    </div>

    <a href="<?= $url ?>" class="order-stend__button but-default">Подробнее</a>
</div>