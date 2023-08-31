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
$id = $_GET['id'];

$projects = $db->prepare('SELECT * from projects where id=?');
$projects->execute(array(
    $id
));
$project = $projects->fetch();

$color = '';
if($project['color_type'] == 'pink'){
    $color = '#FEEEED';
}elseif($project['color_type'] == 'sky'){
    $color = '#F0F8FF';
}else{
    $color = 'white';
}
?>

<?php
// require('task/store.php');
// if(!empty($_POST)){
//     if($_POST['name'] == ''){
//         $error['name'] = 'blank';
//     }
//     if(empty($error)){
//        $statement = $db->prepare('INSERT into tasks set project_id=?, title=?,description=?,order_num=?,status=?,created_at=Now()');

//         echo $show = $statement->execute(array(
//             $id,
//             $_POST['name'],
//             $_POST['content'],
//             1,
//             $_POST['states']
//         ));
//         unset($_POST);
//         header('Location:index.php');
//         exit();
//     }
// }
$tasks = $db->prepare('SELECT * from tasks where project_id=?');
$tasks->execute(array(
    $id
));
?>

<?php
require('../components/header.php');
// require('Project.php');
?>
<main>
<a href="index.php">&laquo;&nbsp;戻る</a>
<h2><?php echo htmlspecialchars($project['name'],ENT_QUOTES); ?></h2>
<div class="show-flex">
    <div class="show-content show-border">
        <h3>未対応</h3>
        <div id="show-open" onclick="showModalchange('showModal');">
            <p class="show-plus">+ タスクを追加</p>
        </div>
        <div class="showModal" id="showModal">
            <!-- <form> -->
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <input type="hidden" id="status" name="states" value="will">
                <label for="name">タイトル</label><br>
                <input type="text" id="name" name="name"><br>

                <label for="content">詳細</label><br>
                <textarea name="content" id="content" cols="30" rows="5"></textarea><br>

                <div class="text-aligin">
                    <button onclick="closeNewTask('showModal');">削除</button>
                    <button onclick="accessPhpFile()">登録</button>
                </div>
            <!-- </form> -->
        </div>


        <?php foreach($tasks as $task): ?>
        <div id="task<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>" class="card" draggable="true">
            <div>
                <label style="margin-top:15px;">タイトル</label>
                <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['title'],ENT_QUOTES); ?></p>
            </div>
            
            <div>
                <label style="margin:0;padding:0;">詳細</label>
                <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['description'],ENT_QUOTES); ?></p>
            </div>
        
            <div>
                <button onclick="deleteTask()">削除</button>
            </div>
        </div>
        <?php endforeach; ?>
        <div id="new-content"></div>
    </div>
    <div class="show-content show-border">
        <h3>対応中</h3>
    </div>

    <div class="show-content show-border">
        <h3>完了</h3>
    </div>
</div>
<div id="result"></div>
</main>

<style>
    .show-color{
        background-color:<?php echo $color; ?>;
    }
</style>

<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"><script> -->
<?php require('../components/footer.php'); ?>