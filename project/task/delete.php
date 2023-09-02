<?php
require('./Task.php');

if(!empty($_POST)){
    $taskClass = new Task();
    echo $taskClass->delete($_POST['id']);
}
?>