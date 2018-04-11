<?php
// если была нажата кнопка "Отправить"
if(isset($_POST['submit'])) {
    header('Content-Type: application/json');
    $name   =   !empty($_POST['name']) ? substr(htmlspecialchars(trim($_POST['name'])), 0, 1000) : "";
    $phone  =   substr(htmlspecialchars(trim($_POST['phone'])), 0, 1000000);

    $title  = "Заказ с сайта 12PSB:";

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
}?>

