let i = 0;
function headerModalchange(idname){
    var header = document.getElementById(idname);
    i++;
    if(i%2 == 1){
        header.style.display = 'block';
    }else{
        header.style.display = 'none';
    }
}

function Taskdelete(idname){
    var newtask = document.getElementById(idname);
    newtask.style.display = 'none';
}

// let k = 0;
function showModalchange(idname){
    var show = document.getElementById(idname);
    // k++;
    // if(k%2 == 1){
    //     show.style.display = 'block';
    // }else{
    //     show.style.display = 'none';
    // }
    show.style.display = 'block';
}

function closeNewTask(idname){
    var close = document.getElementById(idname);
    close.style.display = 'none';

    var name = document.getElementById("name");
    var discription = document.getElementById("content");
    // 内容を空にする
    name.value = '';
    discription.value = '';
}

let j = 0;
function createModalchange(idname){
    var project = document.getElementById(idname);
    j++;
    if(j%2 == 1){
        project.style.display = 'block';
    }else{
        project.style.display = 'none';
    }
}  


function changewhite(idname){
    var obj = document.getElementById(idname);
    obj.style.backgroundColor = 'white';  //背景色を白にする
}

function changepink(idname){
    var obj = document.getElementById(idname);
    obj.style.backgroundColor = '#FEEEED';  //背景色をピンクにする
}

function changesky(idname){
    var obj = document.getElementById(idname);
    obj.style.backgroundColor = '#F0F8FF';  //背景色を水色にする
}

// 削除ボタンを押せばhtml要素が消える関数をかく
function removeElement(id) {
    var element = document.getElementById(id);
    if (element) {
        element.parentNode.removeChild(element);
    }
}
  