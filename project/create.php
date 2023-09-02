<?php
// ログインチェックする
require('../auth/login-check.php');
// require文を使ってProject.phpを読み込む
require('Project.php');
// プロジェクト処理をクラスを使う


if(!empty($_POST)){
    if($_POST['name'] == ''){
        $error['name'] = 'blank';
    }
    if(empty($error)){
        $projectClass = new Project();
        $projectClass->store($user['id'],$_POST);

        header('Location: ./index.php');
        exit();
    }
}

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
        <label for="description">プロジェクト概要</label><br>
        <textarea name="description" id="description" cols="40" rows="5"></textarea>
        <br>
        <br>

        <label for="color">プロジェクトカラー</label>
        <input type="radio" name="color_type" value="1" onclick="changewhite('target');" checked><img width="30" height="30" src="../assets/images/color-white.png" alt="">
        <input type="radio" name="color_type" value="2" onclick="changepink('target');"><img width="30" height="30" src="../assets/images/color-red.png" alt="">
        <input type="radio" name="color_type" value="3" onclick="changesky('target');"><img width="30" height="30" src="../assets/images/color-blue.png" alt="">
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