<?php

class Database
{
    public static function dbConnect()
    {
        $host = 'mysql93.conoha.ne.jp';
        $dbName = 'rkmcl_tasks';
        $user = 'rkmcl_tasks';
        $passWord = 'task&2525';
        $dsn = "mysql:dbname=$dbName;host=$host;charset=utf8mb4";

        try {
            $db = new PDO($dsn, $user, $passWord);
        } catch(PDOException $e) {
            echo 'DB接続エラー' . $e->getMessage();
            exit();
        }
        return $db;
    }
}
?>