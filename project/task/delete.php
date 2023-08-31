<?php
require('./Task.php');
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['task_id'];
$obj=new connect();

$sql = 'DELETE from tasks where id=:id';
$delete = $obj->delete($sql,$id);
exit();
?>