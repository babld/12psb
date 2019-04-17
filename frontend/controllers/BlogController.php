<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\models\Blog;

class BlogController extends Controller {
    public function actionIndex() {
        return $this->render('index', [
            'models' => Blog::findAll(['active' => 'yes'])
        ]);
    }

    public function actionView($slug) {

        return $this->render('view', [
            'model' => Blog::findOne(['slug' => $slug])
        ]);
    }
}