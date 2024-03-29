<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pistol88\seo\widgets\SeoForm;
use pistol88\gallery\widgets\Gallery;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_text')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
    ]);?>

    <?= $form->field($model, 'text')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
    ]); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?=Gallery::widget(['model' => $model]); ?>

    <?= SeoForm::widget([
        'model' => $model,
        'form' => $form,
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
