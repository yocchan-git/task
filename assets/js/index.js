fetch('../data.json')
  .then(response => response.json()) 
  .then(data =>
    console.log(data)
    ) // データをコンソールに出力
  .catch(error => console.log('エラーが発生しました：', error));