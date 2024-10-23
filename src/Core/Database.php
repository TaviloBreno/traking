<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            $config = require __DIR__ . '/../../config/database.php';

            try {
                self::$connection = new PDO(
                    "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
                    $config['user'],
                    $config['password']
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
