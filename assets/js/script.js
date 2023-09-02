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
    show.style.display = 'block';
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

  