<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cert */

$this->title = 'Create Cert';
$this->params['breadcrumbs'][] = ['label' => 'Certs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
