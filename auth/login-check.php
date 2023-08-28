<?php
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
    $_SESSION['time'] = time();

    $members = $db->prepare('SELECT * from members where id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
}else{
    header('Location:../auth/login.php');
}
?>
