<?php
$this->title = "Поиск $query";
$this->registerMetaTag([
    'name' => 'description',
    'content' => "Поиск: $query"
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $query
]);?>
<div class="container">
    <?php
    if(empty($query)):?>
        <h1>Задан пустой поисковой запрос</h1>
    <?php else:?>
        <h1>Результаты поиска:</h1>
    <?php endif;?>

    <?php
    if(empty($products)):?>
        <p>Ничего не найдено</p>
    <?php else:?>
        <?=$this->render('/blocks/oboruds', [
            'title'     => $query,
            'products'  => $products,
            'catalog'   => '',
            'titleTag'  => 'div'
        ]);?>
    <?php endif;?>
</div>