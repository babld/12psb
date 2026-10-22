<?php

namespace common\components;

class WebErrorHandler extends \yii\web\ErrorHandler
{
    use LegacyNoticesTrait;
}
