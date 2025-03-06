<?php
use app\components\Helper;
$utmData = Helper::getUtmData();
?>
<div class="overlay metal-bg cleafrix">
    <h1>Интересует покупка <?=$name?>?</h1>
    <div class="form-wrapper">
        <div class="border-emul overlay__manager-wrap">
            <div class="overlay__manager">
                <div class="overlay__manager-person">
                    <?php // <div class="corp-col">Директор</div>?>
                    <div>Юдин Алексей</div>
                </div>
                <img src="/i/manager.jpg" class=""/>
            </div>
        </div>

        <form class="overlay__form send">
            <input name="model" type="hidden" value="<?=$name?>" />
            <div class="border-emul mb-10">
                <input type="text" name="name" placeholder="Ваше имя" />
            </div>
            <div class="border-emul mb-10">
                <input type="text" name="phone" placeholder="Ваш телефон" />
            </div>
            <div class="border-emul mb-10">
                <input type="text" name="email" placeholder="Ваша эл. почта" />
            </div>
            <div class="border-emul mb-10">
                <textarea name="mess" class="overlay-ta" placeholder="Комментарий"></textarea>
            </div>
            <?php if($utmData['utm']) : ?>
                <input type="hidden" name="utm" value="<?= $utmData['utm'] ?>" />
            <?php endif; ?>
            <?= YII_ENV == 'prod' ? '<input type="hidden" name="target" value="PRODUCT_LIGHTBOX" />' : '' ?>
            <div class="border-emul clearfix">
                <input name="submit" type="submit" value="Связаться со мной" class="but-default overlay__button"/>
            </div>
        </form>
    </div>
    <script>

        $("form.overlay__form").staFeedback();

    </script>
    <div class="clear"></div>
</div>