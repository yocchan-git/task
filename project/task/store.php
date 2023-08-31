<?php

require('./Task.php');
// もらったjsonデータを解凍
$data = json_decode(file_get_contents("php://input"), true);
// 変数の設定
$test = $data['project_id'];
$title = $data['title'];
$discription = $data['discription'];
$order_num = 1;
$status = $data['status'];

$obj=new connect();
$sql="INSERT into tasks set project_id=:id, title=:title, description=:description, order_num=:order_num, status=:status, created_at=Now()";
//クラスの中の関数の呼び出し
$items=$obj->plural($sql,$test,$title,$discription,$order_num,$status);

// 関数を呼び出して、idを取得する
// $sql2 = "SELECT id from tasks where title=:title";
// $get_id = $obj->getId($sql2,$title);

?>