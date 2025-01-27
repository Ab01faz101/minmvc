<?php

namespace Core;

use PDO;
use PDOException;

class ConnectionDatabase
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
