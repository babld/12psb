<?php
use pistol88\shop\models\Category;
use pistol88\shop\models\Image;
use pistol88\shop\models\Price;
$cur = 'р.';
$title = $products[0]->category->name;
?>
<h2 class="text-center title"><?=$title?></h2>

<div class="oboruds"><?php
    foreach($products as $product) {
        #Временное решение. Переделать
        $tmpUrl = '';
        if(Category::findOne(['id' => Category::findOne(['id' => $product->category->parent_id])->parent_id])) {
            $tmpUrl = Category::findOne(['id' => Category::findOne(['id' => $product->category->parent_id])->parent_id])->slug . '/';
        }

        $detailUrl = '/' .
            $tmpUrl .
            Category::findOne(['id' => $product->category->parent_id])->slug . '/' .
            $product->category->slug . '/' .
            $product->slug;
        $image = Image::find()->where(['itemid' => $product->id, 'isMain' => 1])->one()
            ? Image::find()->where(['itemid' => $product->id, 'isMain' => 1])->one()
            : Image::find()->where(['itemid' => $product->id])->one();
        $priceArr = Price::find()->where(['product_id' => $product->id])->all();
        $price = $priceArr[0]->price;
        $priceOld = $priceArr[0]->price_old;?>

        <div class="oborud">
            <div class="oborud__image">
                <a href="<?=$detailUrl?>">
                    <img src="/images/store/<?=$image->filePath?>">
                </a>
            </div>
            <div class="oborud__info">
                <div class="oborud__title gray-bg">
                    <a href="<?=$detailUrl?>">
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
                    <a href="<?=$detailUrl?>" class="but-default oborud__more fl-r">Подробнее</a>
                    <div class="oborud__price fl-r"><?=number_format($price, 0, '', ' ') . ' ' . $cur?></div>
                </div>
            </div>
        </div>
    <?php }?>
</div>