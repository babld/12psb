<?php
// если была нажата кнопка "Отправить"
if(isset($_POST['submit'])) {
    $name   =   substr(htmlspecialchars(trim($_POST['name'])), 0, 1000);
    $phone  =   substr(htmlspecialchars(trim($_POST['phone'])), 0, 1000000);

    $title  = "Заказ с сайта 12PSB:";

    $mes = "Здравствуйте. На вашем сайте 12PSB была оставлена заявка:\n";
    $mes = $mes . "Имя: " . $name . "\n";
    $mes = $mes . "Телефон: " . $phone . "\n";

    if(isset($_POST['email']) and !empty($_POST['email']) ) {
        $mess   = $_POST['email'];
        $mes = $mes . "Email: $mess \n";
    }

    if(isset($_POST['mess']) and !empty($_POST['mess']) ) {
        $mess   = $_POST['mess'];
        $mes = $mes . "Cообщение: " . $mess . "\n";
    }

    if(isset($_POST['model']) and !empty($_POST['model'])) {
        $mes = $mes . "Модель: " . $_POST['model'] . "\n";
    }

    if(isset($_POST['utm']) and !empty($_POST['utm'])) {
        $mes = $mes . "UTM метка: " . $_POST['utm'] . "\n";
    }

    $mes = $mes . "\n\n- -\nСообщение сгенерировано автоматически.";

    // $to - кому отправляем
    #$to = ($_COOKIE["from_direct"] == 1)?'kps@sibtransasia.ru':'kps@sibtransasia.ru';
    $to = "info@12psb.ru";
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

