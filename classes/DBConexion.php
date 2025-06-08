<?php

class DBConexion
{
    public const DB_HOST = '127.0.0.1';
    public const DB_PORT = '3306';
    public const DB_USER = 'root';
    public const DB_PASS = '';
    public const DB_SCHEMA = 'dw3_garcia_neiman';

    public function getConexion(): PDO
    {
        $db_dsn = "mysql:host=" . self::DB_HOST . ":" . self::DB_PORT . "; dbname=" . self::DB_SCHEMA . "; charset=utf8mb4";

        try {
            $db = new PDO($db_dsn, self::DB_USER, self::DB_PASS);
        } catch (Throwable $th) {
            echo "Ocurrió un error: " . $th->getMessage();
            exit;
        }

        return $db;
    }
}