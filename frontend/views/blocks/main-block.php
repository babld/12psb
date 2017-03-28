<div class="main-block">
    <div class="container">
        <h3 class="block-title">Акционные предложения</h3>
        <div class="layout-width main-block-slider-wrap">
            <div class="main-block-slider">
                <?php foreach($goods as $good) :?>
                    <div class="main-block-slider-item">
                        <img width="348" height="309" src="i/12psb-main.png" class="main-block-12psb"/>
                        <div class="main-block-stock">В Наличии</div>
                        <div class="main-block-announce-wrap">
                            <div class="main-block-annonce">
                                <div class="main-block-title"><?=$good->name?></div>
                                <div class="main-block-prices">
                                    <div class="main-block-old-price">459 000 р.</div>
                                    <div class="main-block-new-price">379 000 р.</div>
                                </div>
                                <div class="main-block-desc">
                                    <p>
                                        <?=$good->text?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="main-block-slider-pagination"></div>
        </div>
    </div>
</div>