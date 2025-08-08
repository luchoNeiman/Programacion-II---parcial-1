<?php

class DBConexionStatic
{
    public const DB_HOST = '127.0.0.1';
    public const DB_PORT = '3306';
    public const DB_USER = 'root';
    public const DB_PASS = '';
    public const DB_SCHEMA = 'dw3_garcia_neiman';

    private static ?PDO $db = null;

    public static function getConexion(): PDO
    {
        $db_dsn = "mysql:host=" . self::DB_HOST . ":" . self::DB_PORT . "; dbname=" . self::DB_SCHEMA . "; charset=utf8mb4";

        if (!self::$db) {
            try {
                self::$db = new PDO($db_dsn, self::DB_USER, self::DB_PASS);
            } catch (Throwable $th) {
                echo "Ocurrió un error: " . $th->getMessage();
                exit;
            }
        }

        return self::$db;
    }
}
