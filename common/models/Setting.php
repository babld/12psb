<?php

namespace common\models;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property int|null $is_active
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['is_active'], 'integer'],
            [['key', 'value', 'title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Значение',
            'title' => 'Заголовок',
            'is_active' => 'Active',
        ];
    }
}
