let btn_add_comment;
let text_remark;
let screenDisplay;

document.addEventListener('DOMContentLoaded',()=>{

    btn_add_comment = document.querySelector('#send');
    text_remark = document.querySelector('#comment');
    screenDisplay = document.querySelector('.screen');
    btn_add_comment.addEventListener('click',registerNewComment);
    
})

/****** 
* fonction qui permet d'enregistrer
* un commentaire et de l'afficher
******************************************/
function registerNewComment(){
    let request = new XMLHttpRequest();
    request.open('POST','registerComment.php',true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.onload=()=>{
        
        let html = "";
        let data = JSON.parse(request.responseText);
        for (const key in data) {
            html = `<div class="remark">
                        <div class="icone"><img src="" alt="img"></div>
                        <p><strong>${key}</strong><br><br>${data[key]}</p>
                    </div>
                 `;
        }
        
        screenDisplay.insertAdjacentHTML('afterbegin',html);
    }

    request.send("content="+text_remark.value);
    text_remark.value = "";
}