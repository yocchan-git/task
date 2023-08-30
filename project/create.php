<?php
require('../db/dbconnect.php');
session_start();
// require文を使ってProject.phpを読み込む
require('./Project.php');
// プロジェクト処理をクラスを使う
// インスタンス化する
$obj=new connectProject();
// 変数に$_POSTの値を取り込む
$id = $_SESSION['id'];
$name = $_POST['name'];
$project = $_POST['project'];
$color = $_POST['color'];
// functionを実行する

if(!empty($_POST)){
    if($_POST['name'] == ''){
        $error['name'] = 'blank';
    }
    if(empty($error)){

        $sql="INSERT into projects set user_id=:id, name=:name,description=:description,color_type=:color,created=Now()";
        $task=$obj->plural($sql,$id,$name,$project,$color);
        // $tasks = $db->prepare('INSERT into projects set user_id=?, name=?,description=?,color_type=?,created=Now()');
        // echo $task = $tasks->execute(array(
        //     $_SESSION['id'],
        //     $_POST['name'],
        //     $_POST['project'],
        //     $_POST['color']
        // ));

        unset($_POST);
        echo header('Location:index.php');
        exit();
    }
}

require('../auth/login-check.php');
?>
<?php
$users = $db->prepare('SELECT * from users where id=?');
$users->execute(array(
    $_SESSION['id']
));
$user = $users->fetch();

require('../components/header.php');
?>
<main>
<h2 style="text-align:center;">プロジェクト作成</h2>

<div class="border">
<form class="create-form" action="" method="post" enctype="multipart/form-data">
    <br>
    <label for="name">プロジェクト名<span>必須</span></label>
    <input type="text" size="30" id="name" name="name">
    <?php if($error['name'] == 'blank'): ?>
        <p class="error">プロジェクト名を入力してください</p>
    <?php endif; ?>
    <br>

    <div style="display:flex;" onclick="createModalchange('projectModal');" id="create-set">
        <p style="margin:0;padding:0;">詳細設定</p><i style="margin-top:3px;margin-left:3px;" class="fa-solid fa-caret-down ml-1"></i>
    </div>

    <div class="projectModal" id="projectModal">
        <br>
        <label for="project">プロジェクト概要</label><br>
        <textarea name="project" id="project" cols="40" rows="5"></textarea>
        <br>
        <br>

        <label for="color">プロジェクトカラー</label>
        <input type="radio" name="color" value="white" onclick="changewhite('target');" checked><img width="30" height="30" src="../assets/images/color-white.png" alt="">
        <input type="radio" name="color" value="pink" onclick="changepink('target');"><img width="30" height="30" src="../assets/images/color-red.png" alt="">
        <input type="radio" name="color" value="sky" onclick="changesky('target');"><img width="30" height="30" src="../assets/images/color-blue.png" alt="">
    </div>

    <div class="create-select">
      <a href="index.php">戻る</a>
      <input class="create-btn" type="submit" value="登録">
      <br>
    </div>
    
</form>
</div>
</main>


<?php require('../components/footer.php'); ?>