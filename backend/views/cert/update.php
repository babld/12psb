<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cert */

$this->title = 'Обновить запись: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Certs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cert-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
