<?php
declare(strict_types=1);

class Logger
{
    public static function log(string $message, string $level = 'INFO'): void
    {
        $logDir = __DIR__ . '/../../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $logFile = $logDir . '/app_' . date('Y-m-d') . '.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] [$level] $message" . PHP_EOL;

        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }

    public static function error(string $message): void
    {
        self::log($message, 'ERROR');
    }

    public static function warning(string $message): void
    {
        self::log($message, 'WARNING');
    }

    public static function info(string $message): void
    {
        self::log($message, 'INFO');
    }

    public static function debug(string $message): void
    {
        self::log($message, 'DEBUG');
    }
}