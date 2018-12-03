<?php
$this->title = 'Отзывы наших клиентов | 12psb.ru';
$this->params['pageComponent'] = 'review';
?>
<?=$this->render('/blocks/reviews');?>
<div class="container">
    <div class="article__review mt-50">
        <?php if(!empty($productReviews)): ?>
            <div class="article__review-items content">
                <h2>Отзывы о нашей продукции:</h2>
                <?php foreach($productReviews as $review) : ?>
                    <div class="article__review-item article__review-item_flex">
                        <div class="article__review-image-wrap">
                            <img class="article__review-image" src="<?= $review->product->image->getUrl('200') ?>" />
                        </div>
                        <div class="article__review-item-data">
                            <h5 class="article__review-item-title"><?= $review->product->name ?></h5>
                            <p><?= $review->name ?></p>
                            <p><?= $review->message ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?=$this->render('/blocks/footer-form');?>
