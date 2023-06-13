// calcul totals encodage



console.log('f,;,f:;')

const inputs = document.querySelectorAll('.calcul input');
const divers = document.querySelector('.autre .center input')

divers.addEventListener('input', function(){
    console.log('click')
    if(divers.value<0)
    {
        divers.value=0
    }
    calcul ();
    
})


inputs.forEach((input) => {
  input.addEventListener('input', function() {
    
    if(input.value<0)
    {
        input.value=0
    }
    calcul ();

  });
});

function calcul() {
    const datas = document.querySelectorAll('.calcul input');
    var total = 0;
    datas.forEach((input) => {
        var value = input.value;
        const data = input.getAttribute('data');
        if (value=== '' )
        {
            value=0
        }
        else if(parseFloat(value) < 0) {
            value=0
            
        } 
    total = total + (data*value) 
    
    if(total <0 )
    {
        total=0;
    }

    });
    const autre = document.querySelector('.autre .center input')
    var value2
    value2=parseFloat(autre.value)
    if(isNaN(value2))
    {
        value2=0
    }    
    total=total+value2
    const affichage = document.querySelector('.total p span')
    const resultat = total.toFixed(2)
    affichage.innerHTML= resultat
  }