<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@webroot', dirname(dirname(__DIR__)) . '/frontend/web');
Yii::setAlias('@web', dirname(dirname(__DIR__)) . '/frontend/web');
Yii::setAlias('@storageUrl','/frontend/web/images');


// PHP 8.4+: old libraries (Swiftmailer, pistol88, dektrium, ...) raise E_DEPRECATED,
// and Yii turns every reported notice into an exception (HTTP 500).
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
