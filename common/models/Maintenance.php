<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "maintenance".
 *
 * @property int $id
 * @property string $title
 * @property string $short_text
 * @property string $text
 */
class Maintenance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_text', 'text'], 'string'],
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
            'short_text' => 'Short Text',
            'text' => 'Text',
        ];
    }
}
