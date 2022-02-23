let idArticle;
let btn_del;


document.addEventListener('DOMContentLoaded',()=>{

    btn_del = document.querySelectorAll(".del");

    btn_del.forEach(function(btn){
        btn.addEventListener('click',delArticle);
    })
})

function delArticle(e){
    idArticle = e.target.dataset.id;

    fetch("removeArticle.php?id="+idArticle)
    .then(response => response.text())
    .then(data => {
        document.querySelector("#ar-"+idArticle).remove();
    })
    .catch(err => console.error(err));
}