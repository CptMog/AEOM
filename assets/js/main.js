// import frLocale from '@fullcalendar/core/locales/fr';
/***************************
 *  VARIABLES ET CONSTANTES 
 *****************************/

let tabSlide = [1,0,0];
let slide_timer;
let r_arrow;
let l_arrow;

// let burgerMenu;
// let ico_closeMenu;


/***************************
 *  COPRS DU PROGRAMME 
 *****************************/

 document.addEventListener('DOMContentLoaded',function(){

    displaySlide();

    r_arrow = document.querySelector('.arw_right');
    r_arrow.addEventListener('click',nextSlide);


    l_arrow = document.querySelector('.arw_left');
    l_arrow.addEventListener('click',prevSlide);

    document.addEventListener('scroll',function(event){
        let menu = document.querySelector('header');
        if(window.scrollY < 90){
            menu.style.backgroundColor = 'rgba(35,67,96,0.'+window.scrollY+')';
        }else{
            menu.style.backgroundColor = 'rgba(35,67,96,1)';
        }
        menu.style.transition ='all .2s';
    })


})


/***************************
 *  FONCTIONS 
 *****************************/


/****** 
* fonction qui affiche la slide 
******************************************/
function displaySlide(){
    clearInterval(slide_timer);
    let slides =document.querySelectorAll('.slide');
    for(let i=0; i < tabSlide.length; i++){
        if(tabSlide[i] == 1){
            slides[i].classList.add('s_active')
        }
    }
    autoplay()
}
/***************************************** */

/****** 
* fonction qui affiche le slide suivante
******************************************/
function nextSlide(){
    let slides =document.querySelectorAll('.slide');
    let pass = 0;
    for(let i=0; i< slides.length; i++){
        if(tabSlide[i] == 1 && pass==0){
            slides[i].classList.remove('s_active')
            tabSlide[i] = 0;
            pass = 1;
            if(i+1 < tabSlide.length){
                tabSlide[i+1] = 1;
            }else{
                tabSlide[0] = 1;
            }
        }
    }

    displaySlide()
}
/***************************************** */

/****** 
* fonction qui affiche le slide précedente
******************************************/
function prevSlide(){
    let slides =document.querySelectorAll('.slide');
    let pass = 0;
    for(let i=0; i< slides.length; i++){
        if(tabSlide[i] == 1 && pass==0){
            slides[i].classList.remove('s_active')
            tabSlide[i] = 0;
            pass = 1;
            if(i-1 >= 0){
                tabSlide[i-1] = 1;
            }else{
                tabSlide[slides.length-1] = 1;
            }
        }
    }

    displaySlide()
}
/***************************************** */


/****** 
* fonction qui lit les slide automatiquement
******************************************/
function autoplay(){
    slide_timer = setInterval(nextSlide,6000);
}
/***************************************** */


// function displayBurgerOrMenu(){
//     if(window.innerWidth <= 475){
//         document.querySelector('.navigation').style.display = 'none';
//         document.querySelector('.fa-bars').style.display='initial';
//         document.querySelector('.fa-times').style.display='initial';
//         document.querySelector('.navigation').classList.add('display_burger');
//     }else{
//         document.querySelector('.navigation').style.display = 'initial';
//         document.querySelector('.fa-bars').style.display='none';
//         document.querySelector('.fa-times').style.display='none';
//         document.querySelector('.navigation').classList.remove('display_burger');
//     }
// }


// function displayMenuBurger(){
//     document.querySelector('.navigation').style.display = 'initial';
// }



// function closeMenuBurger(){
//     document.querySelector('.navigation').style.display = 'none';
// }



