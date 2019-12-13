<?php


namespace core\lib;

use Swoole\Coroutine\System;

class Log
{
    const ERROR   = 'error';
    const WARNING = 'warning';
    const INFO    = 'info';

    public static function log($message, $category = 'info')
    {
        $time = date('Y-m-d H:i:s');
        if (is_object($message) || is_array($message)) {
            $message = json_encode($message);
        }
        $log = "[{$time}]-[{$category}]-[{$message}]\n";
        self::write($log);
    }

    private static function write($message)
    {
        $filename = BASE_PATH . 'app/runtime/logs/' . date('Ymd') . '.log';
        System::writeFile($filename, $message, FILE_APPEND);
    }
}