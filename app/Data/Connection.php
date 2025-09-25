<?php

namespace App\Data;

use PDO;
use PDOException;
use RuntimeException;

class Connection
{
    private static ?PDO $instance = null;

    public static function getPdo(): PDO
    {
        if (self::$instance === null) {
            $config = config('database.connections.mysql');
            
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;port=%s;charset=%s',
                $config['host'],
                $config['database'],
                $config['port'],
                $config['charset'] ?? 'utf8mb4'
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ];

            try {
                self::$instance = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $options
                );
            } catch (PDOException $e) {
                throw new RuntimeException(
                    'Erro na conexão com o banco de dados: ' . $e->getMessage(),
                    (int)$e->getCode()
                );
            }
        }

        return self::$instance;
    }
}