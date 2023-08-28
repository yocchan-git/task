fetch('../data.json')
//   .then(response => response.json()) 
  .then(data =>
    console.log('Hello,World')
    ) // データをコンソールに出力
  .catch(error => console.log('エラーが発生しました：', error));