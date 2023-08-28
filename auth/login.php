<?php
require('../db/dbconnect.php');

session_start();

if($_COOKIE['email'] != ''){
    $_POST['email'] = $_COOKIE['email'];
    $_POST['password'] = $_COOKIE['password'];
    $_POST['save'] = 'on';
}

if(!empty($_POST)){
    if($_POST['email'] != '' && $_POST['password'] != ''){
        $login = $db->prepare('SELECT * from users where email=? and password=?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));

        $member = $login->fetch();

        if($member){
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();
                if($_POST['save'] == 'on'){
                    setcookie('email',$_POST['email'],time()+60*60*24*14);
                    setcookie('password',$_POST['password'],time()+60*60*24*14);
                }

            header('Location:../project/index.php');
            exit();
        }else{
            $error['login'] = 'failed';
        }
    }else{
        $error['login'] = 'blank';
    }
}
?>

<?php
require('../components/header.php');
?>

<main>
 <div class="form-center">
        <h2 style="text-align:center;">ログイン</h2>
        <div class="border">
        <p style="text-align:center;">IDとパスワードを入力してください</p>
    
        <form action="" method="post" enctype="multipart/form-data">
        
            <label for="email">ID</label><br>
            <input type="text" size="35" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'],ENT_QUOTES); ?>">
            <?php if($error['login'] == 'blank'): ?>
                <p class="error">*IDとパスワードをご記入ください</p>
            <?php endif; ?>
            <?php if($error['login'] == 'failed'): ?>
                <p class="error">*ログインに失敗しました。正しくご記入ください。</p>
            <?php endif; ?>
            <br>

            <label for="password">パスワード</label><br>
            <input type="password" size="35" id="password" name="password" value="<?php echo htmlspecialchars($_POST['password'],ENT_QUOTES); ?>">
            <br>

            <p style="margin:0;padding:0;">ログイン情報の記録</p>
            <input type="checkbox" id="save" name="save" value="on"><label for="save">次回からは自動的にログインする</label>

            <div class="btn-center"><input class="new-btn" type="submit" value="ログインする"></div>
        </form>
        </div>
 </div>

        <p style="text-align:center;">新規登録は<a href="register.php">こちら</a></p>
       

</main>

<?php require('../components/footer.php'); ?>