<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FeedbackMessForm extends Model
{
    public $message;
    public $phone;
    public $fullname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['phone'], 'required'],
            ['phone', 'match', 'pattern' => '$^.7.\(\d{3}\).\d{3}.\d{2}.\d{2}$'],
            ['message', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'message' => 'Сообщение'
        ];
    }
}
