<?php
$this->title = 'Гарантии | 12psb.ru';
use yii\widgets\Breadcrumbs;


$title = $model->title;
$this->params['breadcrumbs'][] = $title;

$this->title = $title;
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<div class="container content article">
    <h1><?= $title ?></h1>
    <?= $model->text ?>
</div>
<?= $this->render('/blocks/footer-form');?>
