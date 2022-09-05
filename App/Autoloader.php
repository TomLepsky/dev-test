<?php


namespace App;


class Autoloader
{
    private const DIRS = [
        '',
    ];

    private static function autoload(string $className) : void
    {
        $className = str_replace('\\', '/', $className) . '.php';
        foreach (self::DIRS as $dir) {
            $file = ROOT . "/$dir" . "/$className";
            if (file_exists($file)) {
                include_once $file;
                return;
            }
        }
    }

    public static function run() : void
    {
        spl_autoload_register([self::class, 'autoload']);
    }
}