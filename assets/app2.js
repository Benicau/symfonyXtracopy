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

document.addEventListener('DOMContentLoaded', function() {
    // Récupérer les cases à cocher
    var checkboxes = document.querySelectorAll('.printSelected');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedCheckboxes = Array.from(checkboxes).filter(function(checkbox) {
                return checkbox.checked;
            });
            var selectedCheckboxIds = selectedCheckboxes.map(function(checkbox) {
                return checkbox.id;
            });
            affichage(selectedCheckboxIds);
        });
    });
});

function affichage(selectedCheckboxIds) {
    var colorElements = document.querySelectorAll('.resultat.color');
    var blackWhiteElements = document.querySelectorAll('.resultat.blackWhite');
    var clientColorElement = document.querySelector('.clientColor');
    var clientBlackWhiteElement = document.querySelector('.blackWhite');

    var resultat = [parseInt(clientColorElement.textContent)];
    var blackWhiteResultat = [parseInt(clientBlackWhiteElement.textContent)];

    colorElements.forEach(function(colorElement) {
        var printId = parseInt(colorElement.getAttribute('data'));
        var colorSpan = colorElement.querySelector('span');
        var colorValue = colorSpan ? colorSpan.innerText : '';

        if (selectedCheckboxIds.includes(printId.toString())) {
            resultat.push(parseInt(colorValue));
        }
    });

    blackWhiteElements.forEach(function(blackWhiteElement) {
        var printId = parseInt(blackWhiteElement.getAttribute('data'));
        var blackWhiteSpan = blackWhiteElement.querySelector('span');
        var blackWhiteValue = blackWhiteSpan ? blackWhiteSpan.innerText : '';

        if (selectedCheckboxIds.includes(printId.toString())) {
            blackWhiteResultat.push(parseInt(blackWhiteValue));
        }
    });

    var totalResultat = resultat.reduce(function(acc, value) {
        return acc + value;
    }, 0);

    var totalBlackWhiteResultat = blackWhiteResultat.reduce(function(acc, value) {
        return acc + value;
    }, 0);
    
    
    var color = document.querySelector(".cptColor")
    var noir = document.querySelector(".cptBlackWhite")
    color.innerHTML = totalResultat - resultat[0]
    noir.innerHTML = totalBlackWhiteResultat - blackWhiteResultat[0]
   
}
