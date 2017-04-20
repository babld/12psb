<?php
// если была нажата кнопка "Отправить"
if($_POST['submit']) {
    $name   =   "Неизвестно";#substr(htmlspecialchars(trim($_POST['name'])), 0, 1000);
    $phone  =   substr(htmlspecialchars(trim($_POST['phone'])), 0, 1000000);

    $title  = "Заказ с сайта 12PSB:";

    $mes = "Здравствуйте. На вашем сайте 12PSB была оставлена заявка:\n";
    $mes = $mes . "Имя: " . $name . "\n";
    $mes = $mes . "Телефон: " . $phone . "\n";

    if(isset($_POST['mess']) and !empty($_POST['mess']) ) {
        $mess   = $_POST['mess'];
        $mes = $mes . "Cообщение: " . $mess . "\n";
    }

    if(isset($_POST['model']) and !empty($_POST['model'])) {
        $mes = $mes . "Модель: " . $_POST['model'] . "\n";
    }

    $mes = $mes . "\n\n- -\nСообщение сгенерировано автоматически.";

    // $to - кому отправляем

    $to = (isset($_COOKIE["from_direct"]) and $_COOKIE["from_direct"] == 1)?'order@sibtransasia.ru':'info@12psb.ru';
    #$to = ($_COOKIE["from_direct"] == 1)?'kps@sibtransasia.ru':'kps@sibtransasia.ru';
    // $from - от кого
    $from='no-reply@12psb.ru';

    $headers	= 'From:' . $from . "\r\n" . 'Content-type: text/plain; charset=UTF-8'  . "\r\n";

    // функция, которая отправляет наше письмо
    @mail($to, $title, $mes, $headers); ?>
    <div class="ajax-popup">
        <div class="thank-popup">
            <div class="thank-text">Ваша заявка принята!</div>
        </div>
    </div> <?php
}?>

