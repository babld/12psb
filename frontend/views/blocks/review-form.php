<?php
use yii\widgets\ActiveForm;
use common\models\ProductReview;
use yii\helpers\Html;

$model = new ProductReview();
?>

<section class="review-form">
    <h3>Оставьте свой отзыв</h3>
    <?php $form = ActiveForm::begin(['options' => ['class' => "form review__form"], 'action' => ['site/feedback']]); ?>
    <?= Html::activeHiddenInput($model, 'item_id', ['value' => $product->id]) ?>
    <?= Html::hiddenInput('modelName', $model::className()); ?>

    <?= $form->field($model, 'fullname', ['options' => ['class' => 'form__fullname form__field']])->textInput([
        'maxlength' => true,
        'placeholder' => $model->getAttributeLabel('fullname') . ' *',
    ])->label(false) ?>

    <?= $form->field($model, 'name', ['options' => ['class' => 'form__field']])->textInput([
        'maxlength' => true,
        'placeholder' => $model->getAttributeLabel('name') . ' *',
    ])->label(false) ?>

    <?= $form->field($model, 'email', ['options' => ['class' => 'form__field']])->textInput([
        'maxlength' => true,
        'placeholder' => $model->getAttributeLabel('email'),
    ])->label(false) ?>

    <?= $form->field($model, 'phone', ['options' => ['class' => 'form__field']])->label(false)->textInput([
        'maxlength' => true,
    ])->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (###) ###-##-##',
        'clientOptions' => [
            'alias' =>  'phone',
            'class' => 'form__fullname form__field'
        ],
        'options' => [
            'placeholder' => $model->getAttributeLabel('phone') . ' *',
            'class' => 'form-control'
        ],
    ]) ?>

    <?= $form->field($model, 'message', [])->textarea([
        'placeholder' => 'Сообщение..'
    ])->label(false) ?>

    <?= Html::submitButton('Оставить отзыв', [
        'class' => 'but-default feedback__submit',
        'onClick' => "if(window.yaCounter23212990) { yaCounter23212990.reachGoal('RASHET'); return true;}"
    ]) ?>

    <?php ActiveForm::end() ?>
    <div class="review-form__thankyou-message">
        Ваш отзыв отправлен на модерацию. Спасибо.
    </div>
</section>
