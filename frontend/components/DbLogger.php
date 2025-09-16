<?php

namespace app\components;

use common\models\SystemLog;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class DbLogger implements LoggerInterface
{
    /**
     * @var string
     */
    public $module;

    /**
     * @param $module
     */
    public function __construct($module)
    {
        $this->module = $module;
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function emergency($message, array $context = array()): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @param $level
     * @param $message
     * @param $context
     * @return void
     */
    public function log($level, $message, $context = array()): void
    {
        $log = new SystemLog([
            'module' => $this->module,
            'level' => $level,
            'message' => $message,
            'context' => $context
        ]);

        $log->save();
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function alert($message, array $context = array()): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function critical($message, array $context = array()): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function error($message, array $context = array()): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function warning($message, array $context = array()): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function notice($message, array $context = array()): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function info($message, array $context = array()): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     */
    public function debug($message, array $context = array()): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }
}
