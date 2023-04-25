/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';





// js site

//effet triange carre homme page
var randX = []
var randY = []
var rotation = 0
function move ()
{
    for(var x=0;x<2;x++)
    {
            var chemin = ".layer"+x
        $(chemin).animate({left: randX[x]+"%", top: randY[x]+"%"},10000, randomImage)  
    }
}
function randomImage ()
{
    for(var i=0;i<2;i++)
    {
        randX[i]=Math.floor(Math.random()*100)
        randY[i]=Math.floor(Math.random()*100)
        if(randX[i]>80){randX[i]=80}
        if(randY[i]>80){randY[i]=80}
        if(randX[i]<20){randX[i]=20}
        if(randY[i]<20){randY[i]=20}
     
    }
    move ()

}
function rotationImage () {   
    rotation++
    for (var i=0;i<2;i++)
    {   
            var chemin = ".layer"+i
    var rotationLien = "rotate("+rotation+"deg)"
    $(chemin).css("transform",rotationLien)
    } 
    if (rotation==360){rotation=0}  
}

setInterval(function () {rotationImage()}, 20);
randomImage ()


//slide home
const sliders = document.querySelectorAll('.service');
let currentSlide = 0;
function slideService(slideIndex) {
  for (let i = 0; i < sliders.length; i++) {
    sliders[i].classList.add('none');
  }
  sliders[slideIndex].classList.remove('none');
  sliders[slideIndex].style.opacity = 0;
  setTimeout(() => {
    sliders[slideIndex].style.opacity = 1;
  }, 200);
  currentSlide = slideIndex;
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % sliders.length;
    slideService(currentSlide);
  }

 slideService(currentSlide);  
 setInterval(nextSlide, 10000);



 // menu burger

 const burger = document.querySelector('.menuBurger')
 const slideMenu = document.querySelector('.MenuNavResponsive')

 burger.onclick = () => {
  burger.classList.toggle("open");
  slideMenu.classList.toggle("openSlide")
};

const slideMenuUl = document.querySelector('.MenuNavResponsive ul')
slideMenuUl.onclick = () => {
  burger.classList.toggle("open");
  slideMenu.classList.toggle("openSlide")
};

const logo = document.querySelector('.logo')
logo.onclick = () => {
  burger.classList.toggle("open");
  slideMenu.classList.toggle("openSlide")
};





