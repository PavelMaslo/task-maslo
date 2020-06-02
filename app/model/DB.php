<?php
namespace app\model;

use PDO;
use PDOException;

class DB
{
    protected static $conn = null;

    public static function Connect()
    {
        try {
            $dsn = "mysql:dbname=pavel_xl; host=mysql.zzz.com.ua";
            self::$conn = new PDO('mysql:host=localhost;dbname=test-maslo', "root", "");
            return self::$conn;

        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

}