<?php
$subdomen = '';
$subdomens = '';
$cityName = '';
$cityDatName = '';

if(!empty($_SERVER["HTTP_HOST"])) {
    $subdomenData = explode('.', $_SERVER["HTTP_HOST"]);
    $subdomen = $subdomenData[0];
    $domen = !empty($subdomenData[1]) ? $subdomenData[1] : $subdomen;
    $subdomen = $subdomen != '12psb' ? $subdomen : 'nsk';
    $cityName = $cityDatName = false;
    $subdomens = ['nsk', 'omsk', 'moskva', 'sankt-peterburg', 'ekaterinburg', 'nizhnij-novgorod', 'kazan', 'cheljabinsk', 'rostov-na-donu', 'ufa', 'perm', 'voronezh', 'volgograd', 'samara', 'krasnojarsk'];

    # Появились сайты с dns редиректами на 12psb.ru. (или наш IP), который открывает 12psb. Это плохо для сео. Пример siec.nsk.su, mail.12psb.ru, mail.sibtransasia.ru Пресечение подобных случаев
    if((!in_array($subdomen, $subdomens) or ($domen != '12psb' and $domen != 'ru')) and $domen != 'admin-12psb' and $subdomen != 'admin') {
        exit;
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
            case 'nsk':		        $cityName = 'Новосибирск';	    $cityDatName = 'Новосибирске'; break;
        }
    }
}

return [
    'adminEmail' => 'info@12psb.ru',
    'user.passwordResetTokenExpire' => 3600,
    'city' => [
        'code' => $subdomen,
        'name' => $cityName,
        'nameDat' => $cityDatName
    ],
    'subdomens' => $subdomens,
];
