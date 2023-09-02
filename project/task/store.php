<?php

require('./Task.php');

if(!empty($_POST)){
    $taskClass = new Task();
    echo $taskClass->store($_POST);
}

?>