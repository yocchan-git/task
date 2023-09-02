<!-- データを受け取り、カードの形にして返す -->
<?php


require('./Task.php');

if(!empty($_POST)){
    $taskClass = new Task();
    echo $taskClass->update($_POST);
}
?>
