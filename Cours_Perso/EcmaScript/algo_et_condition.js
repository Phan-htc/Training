/*==============================================================================================================================*/
//                                          LES ALGORITHMES ET LES CONDITIONS 
/*==============================================================================================================================*/
//                                                      RAPPEL 
//================================================================================================================================
//les variables créees par let ou const ne peuvent etre utilisé que dans le bloc dans lequel elles sont déclarées.
//exemple:

// welcomeMessage n'existe pas ici
let userlog = true;
if (userlog){
    let welcomeMessage = "Welcome back !"; // le code ci-contre n'existe pas en dehors de ce if
}else{
    let welcomeMessage = "Welcome new user !"; // le code ci-contre n'existe pas en dehors de ce else
}
// welcomeMessage n'existe pas ici
//================================================================================================================================

// Comme dans toutes les langages de programmation, nous disposons des instructions conditionnel et itératives.
//                                          les conditions if / else

let score = 0;
if (lanceLaBalle) {                                     // si on lance la balle
    if (marque) score++;                                // si on marque alors on ajoute 1 au score
} else {                                                // sinon
    function Message() {                                // on execute la fonction Message()
        var msg = "Vous avez rater le panier";
        console.log(msg)
        alert(msg);
    }
}

//                                                      Le switch
//  Déclaration des variables
let firstUser = {
    name: "Will Alexander",
    age: 33,
    accountLevel: "normal"
};

let secondUser = {
    name: "Sarah Kate",
    age: 21,
    accountLevel: "premium"
};

let thirdUser = {
    name: "Audrey Simon",
    age: 27,
    accountLevel: "mega-premium"
};

switch (firstUser.accountLevel) {                               // Le switch prend la variable a vérifier et une liste de valeur
    case 'normal':                                              // Chaque cas doit commencer par case
          console.log('You have a normal account!');            
    
    break;                                                      // La fin des instructions d'un cas doit finir par un break
    case 'premium':
          console.log('You have a premium account!');
    
    break;
    case 'mega-premium':
          console.log('You have a mega premium account!');
    break;
    
    default:                                                    // si aucun cas ne correspond, on affecte une commande par défaut
          console.log('Unknown account type!');
    }

// le switch est préférable a un enchainement de if/else car il est plus lisible et plus élégant sur le plan de la conception.


