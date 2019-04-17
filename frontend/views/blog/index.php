<?php
use yii\widgets\Breadcrumbs;

$title = "Блог";
$this->title = $title;
$this->params['breadcrumbs'][] = $title;
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<div class="container blog">
    <h1 class="block-title"><?= $title ?></h1>
    <div class="blog__items">
    <?php foreach($models as $model): ?>
        <article class="blog__item article">
            <a href="/blog/<?= $model->slug?>">
                <h3><?= $model->title ?></h3>
                <img src="<?= $model->image->getUrl('300x300') ?>" />
            </a>
        </article>
    <?php endforeach ?>
    </div>
</div>