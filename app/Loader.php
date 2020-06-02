<?php

class Loader
{
    public static function loadClass($class)
    {
        $filename = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

        require $filename;
    }

}