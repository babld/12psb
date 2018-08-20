<?php
use yii\helpers\Html;
?>
<section class="instagram section">
    <div class="container">
        <div class="block-title">
            <?= Html::tag('h2', Html::a('Мы в instagram #12PSB', 'https://www.instagram.com/12psb.ru/')) ?>
        </div>

        <div class="instagram__items">
            <div class="owl-three owl-carousel owl-theme">
                <?php
                foreach ($images as $image):
                    echo Html::tag('div',
                        Html::a(
                            Html::img($image->node->thumbnail_src),
                            "//instagram.com/p/{$image->node->shortcode}",
                            ['target' => '_blank']
                        ),
                        ['class' => 'instagram__item']
                    );
                endforeach
                ?>
            </div>
        </div>
    </div>
    <div class="reviews-bottom-line"></div>
</section>