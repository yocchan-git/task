<?php
require('../db/dbconnect.php');
session_start();
?>
<?php
require('../components/header.php');
?>

<?php
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
    unset($_SESSION['id']);
    header('Location:login.php');
}else{
    header('Location:login.php');
}
?>
<?php
require('../components/header.php');
?>