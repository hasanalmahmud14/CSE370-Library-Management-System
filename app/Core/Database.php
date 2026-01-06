<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance;

    public static function connection() {
        if (self::$instance) {
            return self::$instance;
        }

        $config = config('database');
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['name'], $config['charset']);

        try {
            self::$instance = new PDO($dsn, $config['user'], $config['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            if (config('app.debug')) {
                die('Database connection failed: ' . $e->getMessage());
            }
            die('Database connection failed.');
        }

        return self::$instance;
    }
}
