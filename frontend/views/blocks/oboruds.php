<?php
use pistol88\shop\models\Category;
use pistol88\shop\models\Image as PistolImage;
use pistol88\shop\models\Price;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\helpers\Html;

$title = $products[0]->category->name;
?>
<?= Html::tag($titleTag, $title, ['class' => 'title text-center']); ?>

<div class="oboruds clearfix"><?php
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

        $image = PistolImage::find()->where(['itemid' => $product->id, 'isMain' => 1])->one()
            ? PistolImage::find()->where(['itemid' => $product->id, 'isMain' => 1])->one()
            : PistolImage::find()->where(['itemid' => $product->id])->one();
        $priceArr = Price::find()->where(['product_id' => $product->id])->all();

        $price = $priceArr[0]->price;
        $priceOld = $priceArr[0]->price_old;?>

        <div class="oborud">
            <div class="oborud__image">
                <a href="<?=$detailUrl?>"><?php
                    $width = 278;
                    $height = 278;
                    $imagePath = $image->filePath;
                    $path = explode('/', $imagePath);
                    $filename = $width.'x'.$height . '-thumb-' . array_pop($path);
                    $pathToImg = implode('/', $path);
                    if(!file_exists(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename)) {
                        Image::thumbnail(Yii::getAlias('@webroot/images/store/') . $imagePath, $width, $height)
                            ->save(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename, ['quality' => 100]);
                    }?>
                    <img src="<?='/images/cache/' . $pathToImg . '/' . $filename?>">
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
                        <div class="gray-bg oborud__old-price">
                            <?=number_format($priceOld, 0, '', ' ') . Yii::getAlias('@cur')?>
                        </div>
                    <?php endif;?>
                    <a href="<?=$detailUrl?>" class="but-default oborud__more fl-r">Подробнее</a>
                    <div class="oborud__price fl-r"><?=number_format($price, 0, '', ' ') . Yii::getAlias('@cur')?></div>
                </div>
            </div>
        </div>
    <?php }?>
</div>
