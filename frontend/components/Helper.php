<?php
namespace app\components;
use Yii;

class Helper
{
    public static function getUtmData() {
        $session = \Yii::$app->session;
        $phone = \Yii::$app->params['freephone'];
        $cookieName = \Yii::$app->params['cookieName'];
        if($cookieValue = \Yii::$app->request->get($cookieName)) {
            $session[$cookieName] = $cookieValue;

            if (!isset(\Yii::$app->request->cookies[$cookieName])) {
                self::addMyCookie($cookieName, $cookieValue);
            } elseif(\Yii::$app->request->cookies[$cookieName] != $cookieValue) {
                self::addMyCookie($cookieName, $cookieValue);
            }
        } elseif(isset(\Yii::$app->request->cookies[$cookieName])) {
            $session[$cookieName] = \Yii::$app->request->cookies[$cookieName]->value;
        }
        if($session[$cookieName] == 'NT') {
            $phone = \Yii::$app->params['freephone_utm'];
        }

        return ['phone' => $phone, 'utm' => $session[$cookieName]];
    }

    public static function addMyCookie($cookieName, $cookieValue) {
        \Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => $cookieName,
            'value' => $cookieValue,
            'expire' => time() + 86400 * 14
        ]));
    }
    
    public static function textHandl($text) {
        $str = str_replace('#city_dat#', yii::$app->params['city']['nameDat'], $text);
        return str_replace('#city#', yii::$app->params['city']['name'], $str);
    }
}
