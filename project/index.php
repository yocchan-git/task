<?php
require('../db/dbconnect.php');
session_start();

require('../auth/login-check.php');
?>
<?php
$users = $db->prepare('SELECT * from users where id=?');
$users->execute(array(
    $_SESSION['id']
));
$user = $users->fetch();

$projects = $db->prepare('SELECT * from projects where user_id=? order by id desc');
$projects->execute(array(
    $_SESSION['id']
));

require('../components/header.php');
?>
<main>
<div class="text-align">
    <h2>プロジェクト一覧</h2>
    <a class="create-link-btn" href="create.php">新規作成</a>
</div>

<div class="border project-border">
    <div class="text-align">
        <?php foreach($projects as $project): ?>
            <div class="project-div">
             <a class="project-link" href="show.php?id=<?php echo htmlspecialchars($project['id'],ENT_QUOTES); ?>"><?php echo htmlspecialchars($project['name'],ENT_QUOTES); ?></a>
            </div><br>
        <?php endforeach; ?>
    </div>
</div>

</main>


<?php require('../components/footer.php'); ?>