<?php
use app\components\Helper;
$utmData = Helper::getUtmData();
?>
<div class="footer-form" id="4">
    <div class="container">
        <div class="footer-form-block">
            <div class="footer-manager-wrap">
                <img src="../i/manager.png"/>
                <div class="footer-managet-notice">Дмитрий<br/>Менеджер по продаже стендов</div>
            </div>
            <div class="footer-form-wrap">
                <div class="footer-form-title">
                    <span>Нужна консультация</span> по выбору оборудования для <br/>тестирования ТНВД и Common Rail?
                </div>
                <div class="form-wrapper">
                    <form class="feedback-form send" onsubmit="ga('send', 'event', 'CALLBACK', '2'); yaCounter24717443.reachGoal('CALLBACK_BOT'); return true;">
                        <div class="feedback-input-wrapper">
                            <textarea class="feedback-input feedback-textarea"
                                      placeholder="Ваше сообщение" name="mess"></textarea>
                        </div>
                        <div class="feedback-phone-wrapper">
                            <div class="feedback-input-text">Ваш телефон:</div>
                            <i>+7</i>
                            <input type="text" name="phone" class="feedback-input feedback-phone" placeholder="(___) ___ __ __">
                        </div>
                        <input type="submit" name="submit" class="feedback-submit but-default" value="Получить консультацию"/>
                        <?php if($utmData['utm']) : ?>
                            <input type="hidden" name="utm" value="<?= $utmData['utm'] ?>" />
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
