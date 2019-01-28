<?php
use yii\widgets\ActiveForm;
use \frontend\models\FeedbackMessForm;
use app\components\Helper;
use yii\helpers\Html;

$feedbackModel = new FeedbackMessForm();
$formTableFieldOptions = ['template' => '{error}{input}'];
$utmData = Helper::getUtmData();
?>

<?php $form = ActiveForm::begin([
    'action' => '/site/feedback',
    'options' => ['class' => 'feedback__form', 'method' => 'post']
])?>
<?= $form->field($feedbackModel,
    'phone',
    $formTableFieldOptions)->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '+7 (###) ###-##-##',
    'clientOptions' => [
        'alias' =>  'phone',
    ],
    'options' => [
        'placeholder' => 'Ваш телефон',
        'class' => 'feedback__border feedback__input'
    ]
]) ?>

<?= $form->field($feedbackModel, 'fullname', ['options' => ['class' => 'form__fullname form__field']])->textInput([
    'maxlength' => true,
    'placeholder' => $feedbackModel->getAttributeLabel('fullname'),
])->label(false) ?>

<?= Html::hiddenInput('modelName', $feedbackModel::className()); ?>
<?= Html::hiddenInput('requestType', 'feedback') ?>

<?= $form->field($feedbackModel, 'message', $formTableFieldOptions)->textArea([
    'placeholder' => $feedbackModel->getAttributeLabel('Есть вопросы по покупке стендов ТНВД и Common Rail? Я оперативно отвечу на них! Напишите Ваш вопрос здесь'),
    'class' => 'feedback__border feedback__textarea'
]) ?>

<?php if($utmData['utm']) : ?>
    <input type="hidden" name="utm" value="<?= $utmData['utm'] ?>" />
<?php endif; ?>
<?= YII_ENV == 'prod' ? '<input type="hidden" name="target" value="PRODUCT" />' : '' ?>
<input name="submit" type="submit" class="but-default feedback__submit" value="Связаться со мной"/>
<?php ActiveForm::end(); ?>