function accessPhpFile() {
  let url = 'http://localhost/tasks/project/show.php';
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
      if ( xhr.readyState === 4 ) {
          if( xhr.status == 200) {
              let taskname = document.getElementById('name').value;
              let taskcontent = document.getElementById('content').value;
              let id = document.getElementById('id').value;
              let status = document.getElementById('status').value;
              window.location.href = 'http://localhost/tasks/project/task/store.php?id='+id+'&title='+taskname+'&discription='+taskcontent+'&status='+status;
              //通信成功時の処理
          } else {
            window.alert('通信失敗やで');
              //通信失敗時の処理
          }
          //通信の成否に関わらず実行する処理
      }
  };
  xhr.open( 'GET', url );
  xhr.send(null);

  

  // postを使う方法
  // xhr.open('GET', '../project/task/store.php');
  // xhr.send();
}