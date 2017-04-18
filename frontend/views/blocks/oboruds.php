<?php
use pistol88\shop\models\Image;
use pistol88\shop\models\Price;
$cur = 'р.';
?>
<h2 class="text-center title"><?=$title?></h2>

<div class="oboruds"><?php
    foreach($products as $product) {
        $image = Image::find()->where(['itemid' => $product->id])->one();
        $priceArr = Price::find()->where(['product_id' => $product->id])->all();
        $price = $priceArr[0]->price;
        $priceOld = $priceArr[0]->price_old;?>

        <div class="oborud">
            <div class="oborud__image">
                <img src="/images/store/<?=$image->filePath?>">
            </div>
            <div class="oborud__info">
                <div class="oborud__title gray-bg">
                    <a href="/catalog/<?=$product->id;?>">
                        <?=$product->name?>
                    </a>
                </div>
                <div class="oborud__descr">
                    <?=$product->short_text?>
                </div>
                <div class="oborud__foot">
                    <?php if($priceOld):?>
                        <div class="fl-l">
                            <div class="gray-bg">
                                <div class="crossing oborud__old-price">
                                    <?=number_format($priceOld, 0, '', ' ') . ' ' . $cur?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="oborud__price fl-l"><?=number_format($price, 0, '', ' ') . ' ' . $cur?></div>
                    <a href="/catalog/<?=$product->id?>" class="but-default oborud__more fl-l">Подробнее</a>
                </div>
            </div>
        </div>
    <?php }?>
</div>