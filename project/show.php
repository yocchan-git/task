<?php

require('../auth/login-check.php');
require('Project.php');
require('task/Task.php');

$projectId = $_GET['project_id'];

$projectClass = new Project();
$project = $projectClass->getMyProject($user['id'],$projectId);
if($project === false){
    echo '該当するプロジェクトはありません';
}
// 背景の色を取得する
$color = '';
if($project['color_type'] == 2){
    $color = '#FEEEED';
}elseif($project['color_type'] == 3){
    $color = '#F0F8FF';
}else{
    $color = 'white';
}

$taskClass = new Task();
$tasksAtStatusNot = $taskClass->getTasks($projectId, Task::STATUS_NOT);
$tasksAtStatusDo = $taskClass->getTasks($projectId,Task::STATUS_DO);
$tasksAtStatusFin = $taskClass->getTasks($projectId,Task::STATUS_FIN);

require('../components/header.php');

?>
<main>
    <a href="index.php">&laquo;&nbsp;戻る</a>
    <h2><?php echo htmlspecialchars($project['name'],ENT_QUOTES); ?></h2>
    <div class="show-flex tasks">
        <div class="show-content show-border task-block" id="task-not">
            <h3>未対応</h3>
            <div id="show-open" onclick="showModalchange('new-task');">
                <p class="show-plus">+ タスクを追加</p>
            </div>
            <div class="showModal" id="new-task">
                <form name="new_task_form" onsubmit="storeNewTask()">
                    <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($projectId,ENT_QUOTES); ?>">
                    <label for="title">タイトル</label><br>
                    <input type="text" id="title" name="title"><br>

                    <label for="description">詳細</label><br>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea><br>

                    <div class="text-aligin">
                        <button onclick="closeNewTask();">削除</button>
                        <button>登録</button>
                    </div>
                </form>
            </div>


            <?php foreach($tasksAtStatusNot as $task): ?>
            <div id="task<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>" class="card task" draggable="true">
                <div>
                    <label style="margin-top:15px;">タイトル</label>
                    <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['title'],ENT_QUOTES); ?></p>
                </div>
                
                <div>
                    <label style="margin:0;padding:0;">詳細</label>
                    <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['description'],ENT_QUOTES); ?></p>
                </div>
            
                <div>
                    <button onclick="deleteTask(<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>)">削除</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div><!-- task-not -->
        <div class="show-content show-border task-block" id="task-do">
            <h3>対応中</h3>
            <?php foreach($tasksAtStatusDo as $task): ?>
            <div id="task<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>" class="card task" draggable="true">
                <div>
                    <label style="margin-top:15px;">タイトル</label>
                    <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['title'],ENT_QUOTES); ?></p>
                </div>
                
                <div>
                    <label style="margin:0;padding:0;">詳細</label>
                    <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['description'],ENT_QUOTES); ?></p>
                </div>
            
                <div>
                    <button onclick="deleteTask(<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>)">削除</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div><!-- task-do -->
        <div class="show-content show-border task-block" id="task-fin">
            <h3>完了</h3>
            <?php foreach($tasksAtStatusFin as $task): ?>
            <div id="task<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>" class="card task" draggable="true">
                <div>
                    <label style="margin-top:15px;">タイトル</label>
                    <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['title'],ENT_QUOTES); ?></p>
                </div>
                
                <div>
                    <label style="margin:0;padding:0;">詳細</label>
                    <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($task['description'],ENT_QUOTES); ?></p>
                </div>
            
                <div>
                    <button onclick="deleteTask(<?php echo htmlspecialchars($task['id'],ENT_QUOTES); ?>)">削除</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div><!-- task-fin -->
    </div>
</main>

<style>
    .show-color{
        background-color:<?php echo $color; ?>;
    }
</style>
<?php require('../components/footer.php'); ?>