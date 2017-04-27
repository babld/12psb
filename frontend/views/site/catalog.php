<div class="container">
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb">Главная</a>
        <?php foreach($breadcrumbs as $breadcrumb):?>
            <a href="/<?=$breadcrumb['link']?>" class="breadcrumb"><?=$breadcrumb['name']?></a>
        <?php endforeach;?>

        <!--span class="breadcrumb">Каталог</span-->
    </div>
</div>
<?php
$i = 0;
foreach($products as $product):?>
    <?php if(!empty($product['product'])):
        if($i % 2 == 0):
            if($i > 1):?><div class="dark-block-separator"></div><?php endif;?>
            <div class="container">
                <?=$this->render('/blocks/oboruds', [
                    'products'  => $product['product']
                ]);?>
            </div>
        <?php else:?>
            <div class="metal-bg">
                <div class="light-block-separator"></div>
                <div class="container">
                    <?=$this->render('/blocks/oboruds', [
                        'products'  => $product['product']
                    ]);?>
                </div>
            </div>
        <?php endif;
        $i++;
    endif;?>
<?php endforeach; ?>
