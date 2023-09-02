<?php
// データベースに登録する処理
require_once('../db/dbconnection.php');

class Project
{
  // データベースに接続する処理
  private ?PDO $db;

  public function __construct(){
    $this->db = Database::dbConnect();
  }


  // projectsに登録する機能
  public function store(int $userId, array $params)
  {
    $statement = $this->db->prepare('INSERT into projects set user_id=?, name=?, description=?, color_type=?, created=Now()');
    $statement->execute(array(
      $userId,
      $params['name'],
      $params['description'],
      $params['color_type']
    ));
  }
  // projectsから一覧を取り出すファンクション
  public function getMyProjects(int $userId): array
  {
    $query = $this->db->prepare('SELECT * from projects where user_id=? order by id desc');
    $query->execute(array($userId));
    return $query->fetchALL(PDO::FETCH_ASSOC);
  }

  // show.phpに表示する名前などを取り出す処理
  public function getMyProject(int $userId, int $projectId)
  {
    $query = $this->db->prepare('SELECT * from projects where id=? and user_id=?');
    $query->execute(array(
      $projectId,
      $userId
    ));
    return $query->fetch();
  }
}
?>