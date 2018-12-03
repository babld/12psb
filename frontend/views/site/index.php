<?php
$title = "Оборудование для ремонта ТНВД и форсунок";
$this->title = $title;
$this->params['pageComponent'] = 'index';
$this->registerMetaTag(['og:title' => $title]);
$this->registerMetaTag(['name' => 'description', 'content' => "Продажа оборудования для ремонта и регулировки топливной аппаратуры. Низкие цены на стенды для ТНВД и форсунок. Доставка по всей России ☎ 8-800-775-6758"]);
?>

<?= $this->render('@frontend/views/blocks/main-block', ['goods' => $goods]) ?>
<?= $this->render('@frontend/views/blocks/order', ['goods' => $products]);?>
<?= $this->render('@frontend/views/blocks/video', ['videos' => $videos]) ?>
<?= $this->render('@frontend/views/blocks/about') ?>
<?= $this->render('@frontend/views/blocks/pluses') ?>
<?= $this->render('@frontend/views/blocks/certs') ?>
<?= $this->render('@frontend/views/blocks/why-we') ?>
<?= $this->render('@frontend/views/blocks/reviews') ?>
<?= $this->render('@frontend/views/blocks/instagramm', ['images' => $instImages]) ?>
<?= $this->render('@frontend/views/blocks/footer-form') ?>
