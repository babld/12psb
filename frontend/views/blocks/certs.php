<?php
use common\models\Cert;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
?>
<div class="certs gradient-bg">
    <div class="container">
        <div class="owl-three certs__gallery owl-carousel owl-theme">
            <?php foreach(Cert::findAll(['active' => 'yes']) as $item): ?>
                <?php
                $width = 421;
                $height = 562;
                $imagePath = $item->image->filePath;
                $path = explode('/', $imagePath);
                $filename = $width.'x'.$height . '-' . array_pop($path);
                $pathToImg = implode('/', $path);
                if(!file_exists(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename)) {
                    Image::getImagine()->open(Yii::getAlias('@webroot/images/store/') . $imagePath)->
                    thumbnail(new Box($width, $height))->
                    save(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename, ['quality' => 90]);
                }
                ?>
                <a href="<?='/images/cache/' . $pathToImg . '/' . $filename?>" rel="fancybox-button" class="lbox" alt="Сертификат" title="Сертификат">
                    <?php
                    $width = 322;
                    $height = 422;
                    $imagePath = $item->image->filePath;
                    $path = explode('/', $imagePath);
                    $filename = $width.'x'.$height . '-' . array_pop($path);
                    $pathToImg = implode('/', $path);
                    if(!file_exists(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename)) {
                        Image::getImagine()->open(Yii::getAlias('@webroot/images/store/') . $imagePath)->
                        thumbnail(new Box($width, $height))->
                        save(Yii::getAlias('@webroot/images/cache/') . $pathToImg . '/' . $filename, ['quality' => 90]);
                    }
                    ?>
                    <img alt="Сертификат" title="Сертификат" src="<?='/images/cache/' . $pathToImg . '/' . $filename?>" />
                </a>
            <?php endforeach ?>
        </div>
    </div>
    <div class="certs-bottom-line"></div>
</div>