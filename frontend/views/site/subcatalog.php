<div class="container">
    <?php
    $breadcrumbsData = array_filter(explode('/', $catalog));
    ?>
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb">Главная</a>
        <a href="/stanki-i-oborudovanie" class="breadcrumb">Каталог</a>
        <span class="breadcrumb"><?=$categoryTitle?></span>
    </div>

    <?=$this->render('/blocks/oboruds', [
        'title'     => $categoryTitle,
        'products'  => $products,
        'catalog'   => $catalog
    ]);?>

</div>