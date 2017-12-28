<?php
$title = "Оборудование для ремонта ТНВД и форсунок";
$this->title = $title;
$this->registerMetaTag(['og:title' => $title]);
$this->registerMetaTag(['description' => "Продажа оборудования для ремонта и регулировки топливной аппаратуры. Низкие цены на стенды для ТНВД и форсунок. Доставка по всей России ☎ 8-800-775-6758"]);
?>

<?=$this->render('/blocks/main-block', [
    'goods' => $goods
])?>
<?=$this->render('/blocks/order', [
    'goods' => $goods
]);?>
<?=$this->render('/blocks/about');?>
<?=$this->render('/blocks/pluses');?>
<?=$this->render('/blocks/certs');?>
<?=$this->render('/blocks/why-we');?>
<?=$this->render('/blocks/reviews');?>
<?=$this->render('/blocks/footer-form');?>
