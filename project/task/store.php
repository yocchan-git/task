<?php

require('./Task.php');
// もらったjsonデータを解凍
$data = json_decode(file_get_contents("php://input"), true);

$test = $data['project_id'];
$title = $data['title'];
$discription = $data['discription'];
$order_num = 1;
$status = $data['status'];

$obj=new connect();

$sql="SELECT * FROM tasks";
$sql2="INSERT into tasks set project_id=:id, title=:title, description=:description, order_num=:order_num, status=:status, created_at=Now()";
//変数の設定
// $test=$_GET['id'];
// $title = $_GET['title'];
// $discription = $_GET['discription'];
// $order_num = 1;
// $status = $_GET['status'];
//クラスの中の関数の呼び出し
$items=$obj->select($sql);
$items2=$obj->plural($sql2,$test,$title,$discription,$order_num,$status);

// header('Location:../show.php?id='.$test);
?>