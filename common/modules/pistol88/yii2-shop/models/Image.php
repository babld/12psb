<?php
namespace pistol88\shop\models;

use Yii;
use yii\helpers\Url;
use pistol88\shop\models\product\ProductQuery;
use yii\db\ActiveQuery;

class Image extends \yii\db\ActiveRecord {
    public static function tableName() {
        return "image";
    }
}
?>