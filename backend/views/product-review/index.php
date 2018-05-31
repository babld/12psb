<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'item_id',
            'name',
            'email:email',
            //'fullname',
            //'message',
            //'phone',
            'is_active',
            //'created_at',
            //'company',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
