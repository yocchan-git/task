<?php
require('../auth/login-check.php');
require('Project.php');

$projectClass = new Project();
$projects = $projectClass->getMyProjects($user['id']);

require('../components/header.php');
?>
<main>
<div class="text-align">
    <h2>プロジェクト一覧</h2>
    <a class="create-link-btn" href="create.php">新規作成</a>
</div>

<div class="border project-border">
    <div class="text-align">
        <?php
        foreach($projects as $project):
        ?>
            <div class="project-div">
                <a class="project-link" href="show.php?project_id=<?php 
                echo htmlspecialchars($project['id'],ENT_QUOTES);
                 ?>">
                    <?php
                     echo htmlspecialchars($project['name'],ENT_QUOTES); 
                    ?>
                </a>
            </div><br>
        <?php
        endforeach;
        ?>
    </div>
</div>

</main>


<?php require('../components/footer.php'); ?>