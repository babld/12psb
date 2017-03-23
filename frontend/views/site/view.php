<?php
use pistol88\shop\models\Product;
$model = new Product();
$product = $model::findOne($id);?>

<h1><?=$product->name?></h1>
<div class="text"><?=$product->text?></div>
<pre>
    <?php var_dump($product)?>
</pre>
