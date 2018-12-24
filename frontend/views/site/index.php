<?php
use common\models\Page;

$this->render('@frontend/views/blocks/_seo', ['model' => Page::findOne(['type' => 'index'])]);
$this->params['pageComponent'] = 'index';
?>

<?= $this->render('@frontend/views/blocks/main-block', ['products' => $products]) ?>
<?= $this->render('@frontend/views/blocks/order', ['goods' => $products]);?>
<?= $this->render('@frontend/views/blocks/video', ['videos' => $videos]) ?>
<?= $this->render('@frontend/views/blocks/about') ?>
<?= $this->render('@frontend/views/blocks/pluses') ?>
<?= $this->render('@frontend/views/blocks/certs') ?>
<?= $this->render('@frontend/views/blocks/why-we') ?>
<?= $this->render('@frontend/views/blocks/reviews') ?>
<?= $this->render('@frontend/views/blocks/instagramm', ['images' => $instImages]) ?>
<?= $this->render('@frontend/views/blocks/footer-form') ?>
