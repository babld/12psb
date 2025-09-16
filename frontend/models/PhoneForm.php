<?php

namespace app\models;

use yii\base\Model;

class PhoneForm extends Model
{
    public $phone;
    public $fullname;

    public function rules()
    {
        return [
            [['phone'], 'required'],
            ['phone', 'match', 'pattern' => '$^.7.\(\d{3}\).\d{3}.\d{2}.\d{2}$'],
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
