<?php
require('../db/dbconnect.php');

session_start();

if(!empty($_POST)){
    if($_POST['name'] == ''){
        $error['name'] = 'blank';
    }
    if($_POST['email'] == ''){
        $error['email'] = 'blank';
    }
    if(strlen($_POST['password']) < 4){
        $error['password'] = 'length';
    }
    if($_POST['password'] == ''){
        $error['password'] = 'blank';
    }

    $fileName = $_FILES['image']['name'];
    if(!empty($fileName)){
        $ext = substr($fileName,-3);
        if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
            $error['image'] = 'type';
        }
    }

    if(empty($error)){
        $member = $db->prepare('SELECT COUNT(*) as cnt from users where email=?');
        $member->execute(array($_POST['email']));
        $record = $member->fetch();
        if($record['cnt'] > 0){
            $error['email'] = 'duplicate';
        }
    }

    if(empty($error)){

        $image = date('YmdHis').$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../assets/images/'//相対パス（imageフォルダ）
        .$image);

        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $image;
        echo header('Location:confirm.php');
        exit();
    }
}

if($_REQUEST['action'] == 'rewrite'){
    $_POST = $_SESSION['join'];
    $error['rewrite'] = true;
}
?>

<?php
require('../components/header.php');
?>

<main>
 <div class="form-center">
        <h2 style="text-align:center;">新規登録</h2>
        <div class="border">
        <p style="text-align:center;">次のフォームに必要事項をご記入してください</p>
    
        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">名前<span>必須</span></label><br>
            <input type="text" size="25" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'],ENT_QUOTES); ?>">
            <?php if($error['name'] == 'blank'): ?>
                <p class="error">*ニックネームを入力してください</p>
            <?php endif; ?>
            <br>

            <label for="email">メールアドレス<span>必須</span></label><br>
            <input type="text" size="35" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'],ENT_QUOTES); ?>">
            <?php if($error['email'] == 'blank'): ?>
                <p class="error">*メールアドレスを入力してください</p>
            <?php endif; ?>
            <?php if($error['email'] == 'duplicate'): ?>
                <p class="error">*指定されたメールアドレスはすでに登録されています</p>
            <?php endif; ?>
            <br>

            <label for="password">パスワード<span>必須</span></label><br>
            <input type="password" size="35" id="password" name="password" value="<?php echo htmlspecialchars($_POST['password'],ENT_QUOTES); ?>">
            <?php if($error['password'] == 'blank'): ?>
                <p class="error">*パスワードを入力してください</p>
            <?php endif; ?>
            <?php if($error['password'] == 'length'): ?>
                <p class="error">*パスワードは4文字以上で入力してください</p>
            <?php endif; ?>
            <br>


            <label for="image">写真など</label>
            <input type="file" name="image" size="35">
            <?php if($error['image'] == 'type'): ?>
            <p class="error">*写真などは「.gif」か「.png」または「.jpg」の画像を指定してください。</p>
            <?php endif; ?>
            <?php if(!empty($error)): ?>
            <p class="error">*恐れ入りますが、画像を改めて指定してください</p>
            <?php endif; ?>
            <br>

            <div class="btn-center"><input class="new-btn" type="submit" value="確認する"></div>
        </form>
        </div>
 </div>

        <p style="text-align:center;">すでに登録済みの方は<a href="login.php">こちら</a></p>
       

</main>

<?php require('../components/footer.php'); ?>