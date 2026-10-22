<?php

namespace common\components;

class ConsoleErrorHandler extends \yii\console\ErrorHandler
{
    use LegacyNoticesTrait;
}
