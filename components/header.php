<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク管理アプリ</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body id="target" class="show-color">
        <?php if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()): ?>
            <header class="page-header">
            <h1 class="header-title">タスク管理アプリ</h1>
                <nav>
                    <ul class="main-nav" id="main-nav" onclick="headerModalchange('modal');">
                        <li><img width="30" height="30" src="../assets/images/<?php echo htmlspecialchars($user['path'],ENT_QUOTES); ?>" alt=""></li>
                        <li><?php echo htmlspecialchars($user['name'],ENT_QUOTES); ?></li>
                        <li><i class="fa-solid fa-caret-down ml-1"></i></li>
                    </ul>
                        <div class="modal" id="modal">
                             <a href="../auth/logout.php">ログアウト</a>
                        </div>
                </nav>
                </header>
        <?php else: ?>
            <header class="page-header">
            <h1 class="header-title">タスク管理アプリ</h1>
            </header>
            <?php endif; ?>

