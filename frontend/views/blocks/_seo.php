<?php
use app\components\Helper;

$title = isset($model->name) ? $model->name : $model->title;
$this->title = Helper::textHandl(!empty($model->seo->title) ? $model->seo->title : $title);
$ogDescription = Helper::textHandl($model->seo->description);
$ogType = !empty($ogType) ?: 'site';
$ogUrl = yii::$app->params['www'] . explode('?', $_SERVER['REQUEST_URI'])[0];

if(!empty(yii::$app->request->get('page'))) {
    $this->title .= ' - Страница № ' . yii::$app->request->get('page');
    $ogDescription = '';
}

$this->registerMetaTag(['name' => 'description', 'content' => $ogDescription]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $ogDescription]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);

if(!empty($model->image)) {
    $this->registerMetaTag(['property' => 'og:image', 'content' => yii::$app->params['www'] . $model->image->getUrl('566x350')]);
}

$this->registerMetaTag(['property' => 'og:url', 'content' => $ogUrl]);
$this->registerMetaTag(['property' => 'og:locale', 'content' => 'ru_RU']);
$this->registerMetaTag(['property' => 'og:site_name', 'content' => 'СибирьТрансАзия']);
?>