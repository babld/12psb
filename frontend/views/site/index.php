<?php
$title = "Топливное оборудование ТНВД и Common Rail в наличии и под заказ";
$this->title = $title;
$this->registerMetaTag(['og:title' => $title]);
$this->registerMetaTag(['description' => "Купить стенды ТНВД и Common Rail по лучшим ценам"]);
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
