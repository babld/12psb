<?php

namespace common\components;

use Yii;

/**
 * PHP 8 сделал предупреждениями то, что в PHP 7 было уведомлениями, а уведомления PHP 7
 * по умолчанию не показывал (E_ALL & ~E_NOTICE). Yii превращает предупреждение в исключение,
 * и старый код, читающий несуществующий ключ или свойство, отдаёт 500.
 * Такие предупреждения пишем в лог и продолжаем, как было на PHP 7.
 */
trait LegacyNoticesTrait
{
    public function handleError($code, $message, $file, $line)
    {
        if ($code === E_WARNING && preg_match(
            '/^(Undefined (array key|variable|property|offset|index)|Attempt to read property|Trying to access array offset on)/',
            $message
        )) {
            Yii::warning("$message in $file:$line", 'php-legacy-notice');

            return true;
        }

        return parent::handleError($code, $message, $file, $line);
    }
}
