<?php
use yii\widgets\Breadcrumbs;

$count = count($breadcrumbs);
for($i = 0; $i < $count; $i++):
    if($i + 1 == $count):
        $this->params['breadcrumbs'][] = $breadcrumbs[$i]['name'];
    else:
        $this->params['breadcrumbs'][] = ['label' => $breadcrumbs[$i]['name'], 'url' => ['/'. $breadcrumbs[$i]['link']]];
    endif;
endfor;

$title = $category->name;
$this->title = $title;
$this->registerMetaTag(['description' => $category->seo->description]);
$this->registerMetaTag(['og:title' => $title]);
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
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
