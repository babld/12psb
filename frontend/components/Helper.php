<?php
namespace app\components;
use Yii;
use yii\helpers\ArrayHelper;

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

    /**
     * @param $post
     * @return string
     */
    public static function formName($post)
    {
        if (ArrayHelper::getValue($post, 'FeedbackMessForm')) {
            $formName = 'FeedbackMessForm';
        } else {
            $formName = 'FeedbackForm';
        }

        return $formName;
    }

    public static function getDigits($data)
    {
        return preg_replace('/\D/', '', $data);
    }

    public static function getSessionAndCookieUtm(string $type = 'string')
    {
        $result = self::getSessionUtm();

        foreach ($_COOKIE as $key => $val) {
            if (stripos($key, 'utm_') === 0 || $key == '_ga' || $key == '_ym_uid' || $key == 'sbjs_current') {
                if ($type === 'string') {
                    $result[$key] = "$key=$val";
                } else {
                    $result[$key] = $val;
                }
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public static function getSessionUtm(string $type = 'string')
    {
        $result = [];

        foreach (Yii::$app->session as $key => $val) {
            if (stripos($key, 'utm_') === 0) {
                if ($type === 'string') {
                    $result[$key] = "$key=$val";
                } else {
                    $result[$key] = $val;
                }
            }
        }

        return $result;
    }
}
