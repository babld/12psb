<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string $short_text
 * @property string $text
 * @property string $active
 * @property string $slug
 * @property string $type
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_text', 'text', 'active'], 'string'],
            [['title', 'slug', 'type'], 'string', 'max' => 255],
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
            'active' => 'Active',
            'slug' => 'Slug',
            'type' => 'Type',
        ];
    }
}
