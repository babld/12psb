<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EmailTracking */

$this->title = 'Update Email Tracking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Email Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-tracking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
