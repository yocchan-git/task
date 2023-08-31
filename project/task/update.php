<!-- データを受け取り、カードの形にして返す -->
<?php
// require('../../db/dbconnect.php');

$data = json_decode(file_get_contents("php://input"), true);

$test = $data['project_id'];
$title = $data['title'];
$discription = $data['discription'];
$order_num = 1;
$status = $data['status'];

?>
<div id="task<?php echo htmlspecialchars($test,ENT_QUOTES); ?>" class="card" draggable="true">
            <div>
                <label style="margin-top:15px;">タイトル</label>
                <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($title,ENT_QUOTES); ?></p>
            </div>
            
            <div>
                <label style="margin:0;padding:0;">詳細</label>
                <p style="margin-top:5px;margin-bottom:10px;"><?php echo htmlspecialchars($discription,ENT_QUOTES); ?></p>
            </div>
        
            <div>
                <button>削除</button>
            </div>
        </div>