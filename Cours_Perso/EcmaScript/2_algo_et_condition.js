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
//=================================================================

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
//=================================================================

//                                                   Les boucles for, while

// les boucles sont très utiles pour répéter des opérations. c'est également plus optimisé qu'un enchainement de if/else.
/*
ATTENTION A DEFINIR UNE CONDITION DE SORTIE. SINON IL Y A UNE BOUCLE INFINI ET UN RISQUE DE PLANTAGE !!!!
*/

// La boucle FOR (pour)
const numberOfPassengers = 10;
for (let i = 0;                          // On créer une variable d'indice [i] qui sert de compteur qui démarre a 0
    i < numberOfPassengers;              // La condition de poursuite de la boucle. dès qu'il s'évalue comme false, on quitte la boucle
    i++) {                               // On incrémente l'indice de 1 à chaque itération de la boucle
   console.log("Passager embarqué !");
}

console.log("Tous les passagers sont embarqués !");

// Dans le cas où on doit parcourir des tableaux évolutif dans le temps, on peux ajouter la propriété length 

for (let i = 0; i < passengers.length; i++) { // poursuit la boucle si il est inférieur à la longueur du tableau passager
    console.log("Passager embarqué !");
 }

// La boucle for in est comparable a for mais il est plus facile a lire et fait le travail d'itération
const passengers = [
    "Will Alexander",
    "Sarah Kate"
]
for (let i in passengers) {
   console.log("Embarquement du passager " + passengers[i]);
}

// la boucle for of au cas ou l'indice d'un element n'est pas necessaire pendant l'itération
for (let passenger of passengers) {
    console.log("Embarquement du passager " + passenger);
 }

//=================================================================

// La boucle while(tant que)
// La boucle while se poursuit tant qu'une condition est vrai.
//exemple

let seatsLeft = 10;
let passengersStillToBoard = 8;
let passengersBoarded = 0;

while (seatsLeft > 0 && passengersStillToBoard > 0) {
    passengersBoarded++; // un passager embarque
    passengersStillToBoard--; // donc il y a un passager de moins à embarquer
    seatsLeft--; // et un siège de moins
}

console.log(passengersBoarded); // imprime 8, car il y a 8 passagers pour 10 sièges

// dans cette exemple, la boucle poursuit son execution jusqu'a ce que seatsLeft et passengersStillToBoard valent 0 