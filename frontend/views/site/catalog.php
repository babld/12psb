<?php
use yii\helpers\Url;

$products = \pistol88\shop\models\Product::find()->limit(10)->all();
foreach($products as $product){?>
    <h2>
        <a href="<?=Url::toRoute(['site/view', 'id'=>$product->id])?>">
            <?=$product->name?>
        </a></h2>
<?php } ?>