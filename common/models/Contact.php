<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $city
 * @property string $code
 * @property string $address
 * @property string $phone
 * @property string $active
 * @property int $sort
 * @property string $lat
 * @property string $lon
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'code', 'address', 'phone', 'lat', 'lon'], 'required'],
            [['active'], 'string'],
            [['sort'], 'integer'],
            [['city', 'code', 'address', 'phone', 'lat', 'lon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city' => Yii::t('app', 'City'),
            'code' => Yii::t('app', 'Code'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'active' => Yii::t('app', 'Active'),
            'sort' => Yii::t('app', 'Sort'),
            'lat' => Yii::t('app', 'Lat'),
            'lon' => Yii::t('app', 'Lon'),
        ];
    }
}
