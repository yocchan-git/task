<?php
$i=1;
if(!empty($_POST)){
    if($_POST['name'] == ''){
        $error['name'] = 'blank';
    }
    if(empty($error)){
       $statement = $db->prepare('INSERT into tasks set project_id=?, title=?,description=?,order_num=?,status=?,created_at=Now()');

        echo $show = $statement->execute(array(
            $id,
            $_POST['name'],
            $_POST['content'],
            $i,
            $_POST['states']
        ));
        unset($_POST);
        // header('Location:index.php');
        // exit();
    }
}
?>