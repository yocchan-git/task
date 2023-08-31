<?php
try{
    $db = new PDO('mysql:dbname=rkmcl_tasks;host=mysql93.conoha.ne.jp;charset=utf8mb4','rkmcl_tasks','task&2525');
}catch(PDOException $e){
    echo 'DB接続エラー:'.$e->getMessage();
}