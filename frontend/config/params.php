<?php
$subdomen = explode('.', $_SERVER["HTTP_HOST"])[0];
$subdomen = $subdomen != '12psb' ? $subdomen : false;
return [
    'adminEmail' => 'info@12psb.ru',
    'freephone' => '8-800-775-6758',
    'freephone_utm' => '8-800-100-7240',
    'mail' => 'info@12psb.ru',
    'cookieName' => 'utm_source',
    'robotEmail' => 'no-reply@12psb.ru',
    'feedbackSubject' => 'На сайте 12psb.ru оставлен отзыв',
    'instagram' => 'https://www.instagram.com/12psb.ru/',
    'subdomen' => $subdomen
];
