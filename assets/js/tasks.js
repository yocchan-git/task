// 
function accessPhpFile() {
  let taskname = document.getElementById('name').value;
  let taskcontent = document.getElementById('content').value;
  let id = document.getElementById('id').value;
  let status = document.getElementById('status').value;
  // データベースに追加したい内容を入れる
  var dataToSend = {
    project_id: id,
    title: taskname,
    discription: taskcontent,
    status: status
  };

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "../project/task/store.php", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.send(JSON.stringify(dataToSend));
  
  xhr.onreadystatechange = () => {
    if ( xhr.readyState === 4 ) {
        if( xhr.status == 200) {
          // 次はここにタスク追加のカードを閉じて欲しい
          closeNewTask('showModal');
          // カードを表示するファンクションを実行する
          var response = xhr.responseText;
          document.getElementById("new-content").innerHTML = response;
            //通信成功時の処理
        } else {
          window.alert('通信失敗やで');
            //通信失敗時の処理
        }
        //通信の成否に関わらず実行する処理
    }
  };

  xhr.open("POST", "../project/task/update.php", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.send(JSON.stringify(dataToSend));
}

// 削除ボタンを押せばタスクカードが消えるファンクションを書く
