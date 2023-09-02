<?php
require_once('../db/dbconnection.php');
session_start();

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];

    $db = Database::dbConnect();
    $login = $db->prepare('SELECT * from users where id=?');
    $login->execute(array($user_id));
    $user = $login->fetch();

    if(!$user){
        header('Location: ../auth/login.php');
        exit();
    }
}else{
    header('Location: ../auth/login.php');
    exit();
}
?>
