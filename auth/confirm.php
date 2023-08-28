<?php
require('../db/dbconnect.php');

session_start();

if(!isset($_SESSION['join'])){
    header('Location: register.php');
    exit();
}
if(!empty($_POST)){
    $statement = $db->prepare('INSERT into users set name=?, email=?,password=?,path=?,created_at=Now()');

    echo $ret = $statement->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        sha1($_SESSION['join']['password']),
        $_SESSION['join']['image']
    ));

    unset($_SESSION['join']);

    header('Location:complete.php');
    exit();
}
?>

<?php
require('../components/header.php');
?>

<main>
 <div class="form-center">
        <h2 style="text-align:center;">新規登録</h2>
        <div class="border">
        <p style="text-align:center;">入力内容をご確認ください</p>
    
        <form action="" method="post">
            <input type="hidden" name="action" value="submit">
        <dl>
            <dt>名前</dt>
            <dd>
            <?php echo htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES); ?>
            </dd>
            <dt>メールアドレス</dt>
            <dd>
            <?php echo htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES); ?>
            </dd>
            <dt>パスワード</dt>
            <dd>
                【表示されません】
            </dd>
            <dt>写真など</dt>
            <dd>
            <img src="../assets/images/<?php echo htmlspecialchars($_SESSION['join']['image'],ENT_QUOTES); ?>" width="100" height="100" alt="">
            </dd>
        </dl>

            <div><a href="register.php?action=rewrite">&laquo;&nbsp;書き直す</a>|<input type="submit" value="登録する"></div>
        </form>
        </div>
 </div>
       

</main>

<?php require('../components/footer.php'); ?>