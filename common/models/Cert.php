<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cert".
 *
 * @property int $id
 * @property string $title
 * @property int $sort
 * @property string $active
 */
class Cert extends \yii\db\ActiveRecord
{
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'pistol88\gallery\behaviors\AttachImages',
                'mode' => 'single',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort'], 'integer'],
            [['active'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sort' => 'Sort',
            'active' => 'Active',
        ];
    }
}
