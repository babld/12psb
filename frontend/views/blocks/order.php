<div class="order">
    <div class="container">
        <div class="order-head">Популярные модели топливного оборудования</div>
        <?php /*<div class="order-stends-title">Стенды для тестирования отечественных и импортных ТНВД</div>*/ ?>
        <div class="order-stend-list owl-carousel owl-theme">
            <?php foreach($goods as $good):
                $product = $good['product'];
                if($good['is_popular'] == "yes"):
                    echo $this->render('@frontend/views/blocks/_orderStand', ['product' => $product, 'good' => $good]);
                endif;
            endforeach;?>
        </div>
    </div>
    <div class="order-bottom"></div>
</div>