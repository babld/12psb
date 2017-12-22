<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "email_tracking".
 *
 * @property int $id
 * @property string $utm_campaign
 * @property string $email
 */
class EmailTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['utm_campaign', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'utm_campaign' => 'Utm Campaign',
            'email' => 'Email',
        ];
    }
}
