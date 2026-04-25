<?php
use common\models\Cert;
use Yii;
?>
<div class="certs gradient-bg">
    <div class="container">
        <div class="owl-three certs__gallery owl-carousel owl-theme">
            <?php foreach(Cert::findAll(['active' => 'yes']) as $item): ?>
                <?php
                $imagePath = $item->image->filePath;
                $hrefUrl = Yii::$app->imageCache->getThumbnailUrl($imagePath, 421, 562, ['quality' => 90]);
                $thumbUrl = Yii::$app->imageCache->getThumbnailUrl($imagePath, 322, 422, ['quality' => 90]);
                ?>
                <a href="<?= $hrefUrl ?>" rel="fancybox-button" class="lbox" alt="Сертификат" title="Сертификат">
                    <img class="owl-lazy" data-src="<?= $thumbUrl ?>" />
                </a>
            <?php endforeach ?>
        </div>
    </div>
    <div class="certs-bottom-line"></div>
</div>
