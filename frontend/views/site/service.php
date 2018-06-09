<?php
$this->title = 'Сервис | 12psb.ru';
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
<div class="container content">
    <div class="article__main">
        <div class="article article__left-col">
            <h1><?= $title ?></h1>
            <?= $model->text ?>
        </div>
        <div class="article__right-col">
            <div class="article__right-order">
                <div class="aritcle__right-order-title">Популярное</div>
                <div class="article__right-owl owl-carousel owl-theme">
                    <?php foreach($goods as $good):
                        // $product = $good['product'];
                        if($good['is_popular'] == "yes"):
                            echo $this->render('@frontend/views/blocks/_orderStand', [/*'product' => $product,*/ 'good' => $good]);
                        endif;
                    endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('/blocks/footer-form');?>
