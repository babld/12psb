<div class="container">
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb">Главная</a>
        <span class="breadcrumb">Каталог</span>
    </div>
    <?=$this->render('/blocks/oboruds', [
        'title'     => 'Стенды для тестирования ТНВД',
        'products'  => $productsTNVD,
        'catalog'   => $catalog
    ]);?>
</div>
<div class="metal-bg">
    <div class="light-block-separator"></div>
    <div class="container">
        <?=$this->render('/blocks/oboruds', [
            'title'     => 'Дополнительное оборудование для диагностики ТНВД',
            'products'  => $productsDopTNVD,
            'catalog'   => $catalog
        ]);?>
    </div>
</div>

<div class="dark-block-separator"></div>
<div class="container">
    <?=$this->render('/blocks/oboruds', [
        'title'     => 'Стенды и оборудование COMMON RAIL',
        'products'  => $productsCR,
        'catalog'   => $catalog
    ]);?>
</div>

<div class="metal-bg">
    <div class="light-block-separator"></div>
    <div class="container">
        <?=$this->render('/blocks/oboruds', [
            'title'     => 'Дополнительное оборудование для диагностики COMMON RAIL',
            'products'  => $productsDopCR,
            'catalog'   => $catalog
        ]);?>
    </div>
</div>
<div class="dark-block-separator"></div>
<div class="container">
    <div class="content">
        <h1><?=$categoryTitle?></h1>
        <?=$categoryText?>
    </div>
</div>
