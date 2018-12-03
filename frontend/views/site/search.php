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
<div class="container search-page">
    <h1 class="text-center"><?= empty($query) ? "Задан пустой поисковой запрос" : "Результаты поиска: $query" ?></h1>
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