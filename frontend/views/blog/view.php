<?php
use yii\widgets\Breadcrumbs;
use app\components\Helper;

$this->params['pageComponent'] = 'product';
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' =>['/blog']];
$this->params['breadcrumbs'][] = $model->title;

$title = Helper::textHandl($model->title);
$this->title = !empty($model->seo->title) ? Helper::textHandl($model->seo->title) : $title;
$this->registerMetaTag(['name' => 'description', 'content' => Helper::textHandl($model->seo->description)]);
$this->registerMetaTag(['og:title' => $this->title]);
?>

<div class="container article">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <h1><?= $model->title ?></h1>
    <div>
        <?= $model->text ?>
    </div>
</div>
