<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_review".
 *
 * @property int $id
 * @property string $name
 * @property string $message
 * @property string $phone
 * @property string $is_active
 * @property int $created_at
 * @property string $company
 */
class ProductReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'message', 'phone', 'email', 'item_id'], 'required'],
            [['is_active', 'message'], 'string'],
            [['created_at', 'item_id'], 'integer'],
            [['email'], 'email'],
            [['name', 'phone', 'company'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'message' => 'Сообщение',
            'phone' => 'Телефон',
            'is_active' => 'Активность',
            'created_at' => 'Created At',
            'company' => 'Компания',
        ];
    }
}
