<?php
namespace Core;

use PDO;
use App\Config;

abstract class Model
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }

    protected static function insert($table, $params = []) 
    {
        $db = static::getDB();
        $valueString = implode(',', array_fill(0, count($params), '?'));
        $columnString = implode(", ", array_keys($params));
        $stmt = $db->prepare("INSERT INTO {$table} ({$columnString}) VALUES ({$valueString})");
        echo "INSERT INTO {$table} ({$columnString}) VALUES ({$valueString})";
        var_dump($params);
        $stmt->execute(array_values($params));
    }

    protected static function select($table, $whereClause, $params = [])
    {
        $db = static::getDB();
        $query = "SELECT * FROM {$table} WHERE $whereClause";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $returnArr = $stmt->fetchAll();
        return $returnArr;
    }

    protected static function query($query) 
    {
        $db = static::getDB();
        foreach ($db->query($query) as $row) {
            var_dump($row);
            return $row;
        }
    }
}
