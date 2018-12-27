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
            [['city', 'code', 'address', 'phone'], 'required'],
            [['active'], 'string'],
            [['sort'], 'integer'],
            [['city', 'code', 'address', 'phone'], 'string', 'max' => 255],
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
        ];
    }
}
