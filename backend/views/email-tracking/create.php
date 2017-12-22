<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EmailTracking */

$this->title = 'Create Email Tracking';
$this->params['breadcrumbs'][] = ['label' => 'Email Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
