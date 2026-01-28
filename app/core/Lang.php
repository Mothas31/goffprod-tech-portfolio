<?php
declare(strict_types=1);

class Lang
{
    private static string $locale = 'fr';
    private static array $messages = [];

    public static function setLocale(string $locale): void
    {
        $path = __DIR__ . '/../lang/' . $locale;

        if (!is_dir($path)) {
            $locale = 'fr';
        }

        self::$locale = $locale;
        self::$messages = []; // reset cache
    }

    public static function get(string $key): string
    {
        [$file, $item] = explode('.', $key, 2);

        if (!isset(self::$messages[$file])) {
            self::loadFile($file);
        }


        return self::$messages[$file][$item] ?? $key;
    }

    private static function loadFile(string $file): void
    {

        
       $path = __DIR__ . '/../lang/' . self::$locale . '/' . $file . '.php';



        
        if (file_exists($path)) { 
            self::$messages[$file] = require $path;
        } else { 
            self::$messages[$file] = [];
        }
    }

    public static function locale(): string
    {
        return self::$locale;
    }
}
