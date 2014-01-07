// Création de variables
var formulaire;
var nbErrors = 0;
var nbChamps = 0;
var name;
// Execute la fonction au chargement du javascript
// Fonction qui recense le nombre de champs dans un formulaire
window.onload = function(){
    formulaire = document.forms[0];
    nbChamps = formulaire.querySelectorAll('input[type=text],input[type=password],textarea').length;
    formulaire.onsubmit = function(){
        return verifier();
    };
};

// Fonction de vérification des champs d'un formulaire
function verifier () {
    nbErrors = 0 ;
    for (var i=0;i<nbChamps;i++)
    {
        name = formulaire.elements[i].getAttribute('name');
        if (formulaire[i].value == ""){
            formulaire.elements[name].parentNode.getElementsByTagName('erreur')[i].style.display = 'block';
            nbErrors++;
        }
        else
        {
            formulaire.elements[name].parentNode.getElementsByTagName('erreur')[i].style.display = 'none';
        }
    }
    return (nbErrors > 0) ? false : true;
};



