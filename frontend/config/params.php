<?php
$subdomenData = explode('.', $_SERVER["HTTP_HOST"]);
$subdomen = $subdomenData[0];
$domen = $subdomenData[1];
$subdomen = $subdomen != '12psb' ? $subdomen : false;
$cityName = $cityDatName = false;
$subdomens = ['', 'omsk', 'moskva', 'sankt-peterburg', 'ekaterinburg', 'nizhnij-novgorod', 'kazan', 'cheljabinsk', 'rostov-na-donu', 'ufa', 'perm', 'voronezh', 'volgograd', 'samara', 'krasnojarsk'];

# Появились сайты с dns редиректами на 12psb.ru. (или наш IP), который открывает 12psb. Это плохо для сео. Пример siec.nsk.su, mail.12psb.ru, mail.sibtransasia.ru Пресечение подобных случаев
if(!in_array($subdomen, $subdomens) or ($domen != '12psb' and $domen != 'ru')) {
    exit();
}

if($subdomen) {
    switch ($subdomen) {
        case "omsk":            $cityName = 'Омск';             $cityDatName = 'Омске'; break;
        case "moskva":          $cityName = 'Москва';           $cityDatName = 'Москве'; break;
        case 'sankt-peterburg': $cityName = 'Санкт-Петербург';  $cityDatName = 'Санкт-Петербурге'; break;
        case 'ekaterinburg':    $cityName = 'Екатеринбург';     $cityDatName = 'Екатеринбурге'; break;
        case 'nizhnij-novgorod':$cityName = 'Нижний Новгород';  $cityDatName = 'Нижнем Новгороде'; break;
        case 'kazan':           $cityName = 'Казань';           $cityDatName = 'Казане'; break;
        case 'cheljabinsk':     $cityName = 'Челябинск';        $cityDatName = 'Челябинске'; break;
        case 'rostov-na-donu':  $cityName = 'Ростов на Дону';   $cityDatName = 'Ростове на Дону'; break;
        case 'ufa':             $cityName = 'Уфа';              $cityDatName = 'Уфе'; break;
        case 'perm':            $cityName = 'Пермь';            $cityDatName = 'Перми'; break;
        case 'voronezh':        $cityName = 'Воронеж';          $cityDatName = 'Воронеже'; break;
        case 'volgograd':       $cityName = 'Волгоград';        $cityDatName = 'Волгограде'; break;
        case 'samara':          $cityName = 'Самара';           $cityDatName = 'Самаре'; break;
        case 'krasnojarsk':     $cityName = 'Красноярск';       $cityDatName = 'Красноярске'; break;
    }
}

return [
    'adminEmail' => 'info@12psb.ru',
    'freephone' => '8-800-775-6758',
    'freephone_utm' => '8-800-100-7240',
    'mail' => 'info@12psb.ru',
    'cookieName' => 'utm_source',
    'robotEmail' => 'no-reply@12psb.ru',
    'feedbackSubject' => 'На сайте 12psb.ru оставлен отзыв',
    'instagram' => 'https://www.instagram.com/12psb.ru/',
    'subdomen' => $subdomen,
    'city' => [
        'name' => $cityName,
        'nameDat' => $cityDatName
    ]
];
