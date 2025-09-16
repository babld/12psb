<?php

namespace frontend\controllers;

use app\components\SendToBitrix;
use yii\rest\Controller;
use yii;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class AjaxFeedback extends Controller
{
    /**
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        var_dump($_POST);exit;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ((!$data = yii::$app->request->post()) && !is_array($data)) {
            throw new yii\web\NotFoundHttpException('Страница не найдена', 404);
        }

        $name = ArrayHelper::getValue($data, 'name');
        $phone = ArrayHelper::getValue($data, 'phone');
        $from = ArrayHelper::getValue($data, 'from');
        $to = ArrayHelper::getValue($data, 'to');
        $weight = ArrayHelper::getValue($data, 'weight');
        $volume = ArrayHelper::getValue($data, 'volume');
        $email = ArrayHelper::getValue($data, 'email');

        $bitrixData = [
            'name' => $name,
            'status_id' => 'NEW',
            'opened' => 'Y',
            'assigned_by_id' => 18,
            'source_id' => 5,
            'source_description' => 'source_description',
            'comments' => '',
            'phone' => [
                ['VALUE' => $phone, 'VALUE_TYPE' => 'WORK']
            ],
            'email' => [
                ['VALUE' => $email, 'VALUE_TYPE' => 'WORK'],
            ],
            'from' => $from, // Пункт отправления (если есть)
            'to' => $to, // Пункт назначения (если есть)
            'weight' => $weight, // Вес (строка) (если есть)
            'volume' => $volume, // Объем (строка) (если есть)
        ];
        (new SendToBitrix())->send($bitrixData);


        $name = yii::$app->request->post('name');
        $phone = substr(htmlspecialchars(trim(yii::$app->request->post('phone', ''))), 0, 1000000);

        $title = "Заказ с сайта 12PSB:";

        $mes = "Здравствуйте. На вашем сайте 12PSB была оставлена заявка:\n";
        $mes .= "Имя: " . $name . "\n";
        $mes .= "Телефон: " . $phone . "\n";

        $mes .= !empty($_POST['email']) ? "Email: " .$_POST['email'] . "\n" : "";
        $mes .= !empty($_POST['mess']) ? "Cообщение: " . $_POST['mess'] . "\n" : "";
        $mes .= !empty($_POST['model']) ? "Модель: " . $_POST['model'] . "\n" : "";
        $mes .= !empty($_POST['utm']) ? "UTM метка: " . $_POST['utm'] . "\n" : "";
        $mes .= "\n\n- -\nСообщение сгенерировано автоматически.";

        // $to - кому отправляем
        #$to = ($_COOKIE["from_direct"] == 1)?'kps@sibtransasia.ru':'kps@sibtransasia.ru';
        $to = "info@12psb.ru, allorders@sibtransasia.ru";
        // $from - от кого
        $from='no-reply@12psb.ru';

        $headers	= 'From:' . $from . "\r\n" . 'Content-type: text/plain; charset=UTF-8'  . "\r\n";

        // функция, которая отправляет наше письмо
        @mail($to, $title, $mes, $headers);



        $responce = [
            'success' => 'true',
            'message' => 'ok',
            'post' => $_POST
        ];
        echo json_encode($responce);
    }
}