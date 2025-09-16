<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class SystemLog
 *
 * @property  int $id
 * @property string $module
 * @property string $level
 * @property string $message
 * @property array $context
 * @property string $timestamp
 */
class SystemLog extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'system_log';
    }
}
