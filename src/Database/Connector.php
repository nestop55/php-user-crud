<?php

namespace App\Database;

use PDO;

class Connector
{
    private static string $host = 'localhost';
    private static string $dbname = 'form_example';
    private static string $user = 'root';
    private static string $password = '123123';
    private static string $charset = 'utf8mb4';

    public static function connect(): PDO
    {
        $dsn = 'mysql:host=' . self::$host
            . ';dbname=' . self::$dbname
            . ';charset=' . self::$charset;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        return new PDO($dsn, self::$user, self::$password, $options);
    }
}
