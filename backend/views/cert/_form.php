<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pistol88\gallery\widgets\Gallery;

/* @var $this yii\web\View */
/* @var $model common\models\Cert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cert-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'active')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>

    <?= Gallery::widget(['model' => $model]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
