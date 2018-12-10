<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use app\components\Helper;

$count = count($breadcrumbs);
for($i = 0; $i < $count; $i++):
    if($i + 1 == $count):
        $this->params['breadcrumbs'][] = $breadcrumbs[$i]['name'];
    else:
        $this->params['breadcrumbs'][] = ['label' => $breadcrumbs[$i]['name'], 'url' => ['/'. $breadcrumbs[$i]['link']]];
    endif;
endfor;

$title = !empty($category->seo->title) ? Helper::textHandl($category->seo->title) : Helper::textHandl($category->name);
$this->title = $title;
$this->registerMetaTag(['name' => 'description', 'content' => Helper::textHandl($category->seo->description)]);
$this->registerMetaTag(['og:title' => $title]);
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?php if($catalog) : ?>
    <?= Html::tag('h1', $title, ['class' => 'title text-center']) ?>
    <?php endif; ?>
</div>
<?php
$i = 0;
foreach($products as $product):?>
    <?php if(!empty($product['product'])):
        if($i % 2 == 0):
            if($i > 1):?><div class="dark-block-separator"></div><?php endif;?>
            <div class="container">
                <?=$this->render('/blocks/oboruds', [
                    'products'  => $product['product'],
                    'titleTag' => $catalog ? 'h2' : $i > 1 ? 'h2' : 'h1'
                ]);?>
                <div class="product-text article">
                    <?= Helper::textHandl($category->text) ?>
                </div>
            </div>
        <?php else:?>
            <div class="metal-bg">
                <div class="light-block-separator"></div>
                <div class="container">
                    <?=$this->render('/blocks/oboruds', [
                        'products'  => $product['product'],
                        'titleTag' => 'h2'
                    ]);?>
                </div>
            </div>
        <?php endif;
        $i++;
    endif;?>
<?php endforeach; ?>
