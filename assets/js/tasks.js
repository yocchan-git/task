// ステータスの設定
const STATUS_NOT = 1;
const STATUS_DO = 2;
const STATUS_FIN = 3;
const STATUS_BY_ID_NAME = {
  'task-not': STATUS_NOT,
  'task-do': STATUS_DO,
  'task-fin': STATUS_FIN
};

const taskNot = document.getElementById('task-not');
const taskDo = document.getElementById('task-do');
const taskFin = document.getElementById('task-fin');
const newTask = document.getElementById('new-task');
let title = document.getElementById('title');
let description = document.getElementById('description');

// 新規カードの削除処理
function closeNewTask(){
  event.preventDefault();
  title.value = '';
  description.value = '';
  newTask.style.display = 'none';
}

function storeNewTask(){
  event.preventDefault();
  const project_id = document.new_task_form.project_id.value;
  const title = document.new_task_form.title.value;
  const description = document.new_task_form.description.value;

  const formData = new FormData();
  formData.append('project_id',project_id);
  formData.append('title',title);
  formData.append('description',description);

  const req = new XMLHttpRequest();
  req.open('POST','../project/task/store.php',true);
  req.send(formData);

  req.onreadystatechange = function () {
    if(req.readyState == 4){
      if(req.status == 200){
        closeNewTask();
        createTaskCard(req.response,title,description);
        dragAndDrop();
      }else{
        console.log('通信中です');
      }
    }
  }
}

// 登録された後のタスクカードを作る
function createTaskCard(id, title, description){

  let card = document.createElement('div');
  card.setAttribute("class","card task");
  card.setAttribute("id","task"+id);
  card.setAttribute("draggable","true");

  // styleに指定する値を変数に先に代入しておく
  let mt_15 = "margin-top:15px;";
  let mtb_510 = "margin-top:5px;margin-bottom:10px;";
  let mtb_0 = "margin:0;padding:0;";
  // タイトルの中身を作る
  let titleForm = document.createElement('div');
  let titleLabel = document.createElement('label');
  titleLabel.setAttribute("style",mt_15);
  titleLabel.textContent= 'タイトル';
  titleForm.appendChild(titleLabel);
  let titleP = document.createElement('p');
  titleP.setAttribute("style",mtb_510);
  titleP.textContent = title;
  titleForm.appendChild(titleP);
  card.appendChild(titleForm);
  // 詳細の中身を作る
  let descriptionForm = document.createElement('div');
  let descriptionLabel = document.createElement('label');
  descriptionLabel.setAttribute("style",mtb_0);
  descriptionLabel.textContent = '詳細';
  descriptionForm.appendChild(descriptionLabel);
  let descriptionP = document.createElement('p');
  descriptionP.setAttribute("style",mtb_510);
  descriptionP.textContent = description;
  descriptionForm.appendChild(descriptionP);
  card.appendChild(descriptionForm);
  // 削除ボタンを作る
  let deleteDiv = document.createElement('div');
  let deleteButton = document.createElement('button');
  deleteButton.onclick = function () {
    deleteTask(id);
  }
  deleteButton.textContent = "削除";
  deleteDiv.appendChild(deleteButton);
  card.appendChild(deleteDiv);
  taskNot.appendChild(card);
}

function updateTask(taskIdList,status){
  const formData = new FormData();
  formData.append('taskIdList',taskIdList);
  formData.append('status',status);

  const req = new XMLHttpRequest();
  req.open('POST','../project/task/update.php',true);
  req.send(formData);

  req.onreadystatechange = function() {
    if(req.readyState == 4){
      if(req.status == 200){
        console.log(req.response);
        console.log('更新完了');
      }
    }else{
      console.log('更新処理中です');
    }
  }
}

function deleteTask(id){
  const req = new XMLHttpRequest();
  req.open('POST','../project/task/delete.php',true);
  req.setRequestHeader('content-type','application/x-www-form-urlencoded;charset=UTF-8');
  req.send('id='+id);

  req.onreadystatechange = function() {
    if(req.readyState == 4){
      if(req.status == 200){
        document.getElementById('task'+id).remove();
      }
    }else{
      console.log('通信中です');
    }
  }
}

window.onload = dragAndDrop();
let flg = false;  // 処理がぶつかるのを防ぐ
function dragAndDrop(){
  document.querySelectorAll('.task').forEach(element =>{
    element.ondragstart = function(){
      flg = false;
      event.dataTransfer.setData('text/plain', event.target.id);
    };

    element.ondragover = function(){
      this.style.borderTop = '3px solid';
    };

    element.ondragleave = function(){
      this.style.borderTop = '';
    };

    // ドロップした時の処理
    element.ondrop = dropOnTasksCard;

    taskNot.ondragover = dragOverOnTasksBlock;
    taskNot.ondrop = dropOnTasksBlock(1);
    taskDo.ondragover = dragOverOnTasksBlock;
    taskDo.ondrop = dropOnTasksBlock(2);
    taskFin.ondragover = dragOverOnTasksBlock;
    taskFin.ondrop = dropOnTasksBlock(3);
  });
}

function dragOverOnTasksBlock(){
  event.preventDefault();
}

function dropOnTasksCard(){
  flg = true;
  event.preventDefault();

  let id = event.dataTransfer.getData('text');
  let element_drag = document.getElementById(id);

  this.parentNode.insertBefore(element_drag,this);
  this.style.borderTop = '';

  const status = STATUS_BY_ID_NAME[event.target.closest(".task-block").id];
  const taskIdList = getTaskIdListByStatus(status);
  updateTask(taskIdList,status);
}

function dropOnTasksBlock(status){
  return function (){
    if(flg){
      return;
    }
    flg = true;
    event.preventDefault();

    let id = event.dataTransfer.getData('text');
    let element_drag = document.getElementById(id);
    this.appendChild(element_drag,this);

    const taskIdList = getTaskIdListByStatus(status);
    updateTask(taskIdList,status);
  }
}

function getTaskIdListByStatus(status){
  let taskIdList = [];
  let tasks;
  switch(status){
    case 2:
      tasks = taskDo;
      break;

    case 3:
      tasks = taskFin;
      break;
    
    default:
      tasks = taskNot;
      break;
  }

  for(const task of tasks.children){
    if(task.className == 'card task'){
      taskIdList.push(task.id.replace('task',""));
    }
  }
  return taskIdList;
}
