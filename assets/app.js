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



