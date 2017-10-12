<?php
function kodermail($mail) {
    $kodermail = '';
    for($j = 0; $j < strlen($mail); $j++) {
        $kodermail .= '&#' . ord(substr($mail, $j, 1)) . ';';
    }
    return $kodermail;
}
Yii::setAlias('@mail', kodermail('info@12psb.ru'));
Yii::setAlias('@cur', ' р.');