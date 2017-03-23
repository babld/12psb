<?php
use pistol88\shop\widgets\ShowPrice;
use pistol88\cart\widgets\BuyButton;
use pistol88\cart\widgets\TruncateButton;
use pistol88\cart\widgets\CartInformer;
use pistol88\cart\widgets\ElementsList;
use pistol88\cart\widgets\ChangeCount;
use pistol88\cart\widgets\ChangeOptions;
use pistol88\promocode\widgets\Enter;
use pistol88\order\widgets\OrderForm;
use pistol88\order\widgets\OneClick;
use pistol88\shop\models\Product;

$model = new Product();
$product = $model::findOne(907); //from controller

$this->title = 'Страница продукта (нет)';
?>
<div class="site-index">
    <h1><?=$product->name;?></h1>

    <h2>Shop</h2>
    <div class="block row">
        <h3>ShowPrice</h3>
        <?=ShowPrice::widget(['model' => $product]);?>
    </div>

    <h2>Cart</h2>
    <div class="block row">
        <div class="col-md-3">
            <h3>ChangeCount</h3>
            <?=ChangeCount::widget(['model' => $product]);?>
        </div>
        <div class="col-md-3">
            <h3>ChangeOptions</h3>
            <?=ChangeOptions::widget(['model' => $product]);?>
        </div>
        <div class="col-md-3">
            <h3>BuyButton</h3>
            <?=BuyButton::widget(['model' => $product]);?>
        </div>
        <div class="col-md-3">
            <h3>TruncateButton</h3>
            <?=TruncateButton::widget();?>
        </div>
        <div class="col-md-3">
            <h3>CartInformer</h3>
            <?=CartInformer::widget();?>
        </div>
        <div class="col-md-6">
            <h3>ElementsList</h3>
            <?=ElementsList::widget(['type' => 'list']); //may bee type => dropdown?>
        </div>
    </div>
    
    <h2>Promocode</h2>
    <div class="block row">
        <?=Enter::widget();?>
    </div>
    
    <h2>Order</h2>
    <div class="block row">
        <h3>Full form</h3>
        <?=OrderForm::widget();?>

        <h3>One click form</h3>
        <?=OneClick::widget(['model' => $product]);?>
    </div>
    
    <style>
        .block {
            border: 2px solid blue;
        }
    </style>

</div>
