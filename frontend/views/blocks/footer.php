<?php
use yii\helpers\Html;
?>
<div class="gray-line"></div>
<div class="footer">
    <div class="container clearfix">
        <div class="footer-info">
            <div class="footer-company-info">
                <div class="clearfix">
                    <?php if(yii::$app->request->pathinfo): ?>
                        <?= Html::a('', '/', ['class' => 'header-logo']) ?>
                    <?php else: ?>
                        <?= Html::tag('span', '', ['class' => 'header-logo']) ?>
                    <?php endif ?>
                </div>

                <div class="footer-company-name">
                    Стенды ТНВД и Common Rail
                </div>
            </div>
            <ul class="footer__info">
                <li class="footer__info-item">Топливное оборудование напрямую от поставщиков в наличии и под заказ</li>
                <li class="footer__info-item"><a href="/catalog">Полный каталог оборудования</a></li>
                <li class="footer__info-item"><a href="/catalog/common-rail">Оборудование для диагностики Common Rail</a></li>
                <li class="footer__info-item"><a href="/catalog/tnvd">Стенды для тестирования ТНВД</a></li>
            </ul>
            <div class="footer-company-cities">
                <ul class="footer-fillials">
                    <?php if($currentCity = \common\models\Contact::findOne([
                        'active' => 'yes',
                        'code' => yii::$app->params['city']['city']
                    ])) : ?>
                        <li data-phone="<?= $currentCity['phone'] ?>"
                            data-city="<?= $currentCity['code'] ?>"
                            class="<?= $currentCity['code'] == 'nsk' ? 'active' : '' ?>">
                                <?= $currentCity['city'] ?>
                                <p class="footer-city-address">
                                    <?= $currentCity->address ?>
                                </p>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
            <div class="footer-right">
                <?php if($currentCity): ?>
                <div class="footer-contacts-phone"><?= $currentCity->phone ?></div>
                <?php endif ?>
                <div class="footer__social">
                    <a rel="nofollow" class="footer__social_vk" href="https://vk.com/12psb" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <a rel="nofollow" class="footer__social_fb" href="https://www.facebook.com/12psb.ru" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a rel="nofollow" class="footer__social_youtube" href="https://www.youtube.com/channel/UCV4obhEY6NCIocc9tJck-6A" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    <a rel="nofollow" class="footer__social_inst" href="https://www.instagram.com/12psb.ru/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="layout-width">

        </div>
    </div>
</div>