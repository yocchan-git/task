<?php
require_once(__DIR__ . '/../../db/dbconnection.php');

class Task {
  const STATUS_NOT = 1;
  const STATUS_DO = 2;
  const STATUS_FIN = 3;

  private ?PDO $db;

  public function __construct(){
    $this->db = Database::dbConnect();
  }

  // タスクの一覧を取得するコード
  public function getTasks(int $projectId, int $status): array
    {
        $query = $this->db->prepare('SELECT * FROM tasks WHERE project_id=? AND status=? ORDER BY order_num');
        $query->execute(array($projectId, $status));
        return $query->fetchALL(PDO::FETCH_ASSOC);
    }

  // タスクを登録する処理
  public function store(array $params): int
  {
    // order_numの値を決めるファンクションをよび、変数に代入
    $newTaskOrderNumber = $this->getNewTaskOrderNum($params['project_id']);
    // prepare文を用意する
    $statement = $this->db->prepare('INSERT into tasks set project_id=?, title=?, description=?, order_num=?, status=?, created_at=Now()');
    // executeで登録する（STATUSは１で登録）
    $statement->execute(array(
      $params['project_id'],
      $params['title'],
      $params['description'],
      $newTaskOrderNumber,
      self::STATUS_NOT
    ));
    // lastInsertIdで最後のIdをruturnする
    return $this->db->lastInsertId();
  }

  // order_numを決める処理をする
  private function getNewTaskOrderNum(int $projectId): int
  {
    // マックスの値を取得する
    $query = $this->db->prepare('SELECT max(order_num) from tasks where project_id=? and status=1');
    $query->execute(array($projectId));
    $tasks = $query->fetch();
    // nullなら１をnullでないなら+1以外の処理を入れる
    if(!empty($tasks)){
      return $tasks[0] + 1;
    }else{
      return 1;
    }
  }

  // タスクの更新処理
  public function update(array $params)
  {
    $taskIds = explode(',',$params['taskIdList']);
    foreach($taskIds as $key => $taskId){
      $statement = $this->db->prepare('UPDATE tasks set order_num=?,status=?,updated_at=Now() where id=?');
      $statement->execute(array(
        $key + 1,
        $params['status'],
        $taskId
      ));
    }
  }
  
  // タスクの削除処理
  public function delete(int $taskId)
  {
    $query = $this->db->prepare('DELETE from tasks where id=?');
    $query->execute(array($taskId));
  }

}
?>

