/*==============================================================================================================================*/
//                                                         LES OPERATEURS
/*==============================================================================================================================*/

// on dispose d'expressions de comparaison tels que:
// < inférieur à     <= inférieur ou égale à         == égale à
// > supérieur à     >= supérieur ou égale à         != différent de

const nombre_de_siege = 50;
const nombre_de_personne = 45;
if(nombre_de_siege != nombre_de_personne){
    console.log("On n'a pas rempli la salle")
} else {
    console.log("On a rempli la salle ! money money money !");
}

// Attention, il y a 2 égalités qui sont différentes.
//== et ===
5 == "5"; // affichera true car elles ont la meme valeur
5 === "5"; // affichera false car elles ont la meme valeur mais pas le meme type 
          // 5 est un entier tandis que "5" est une chaine de caractère

// on peux faire des conditions multiples avec les oppérateurs :
// && ET , || OU ,  ! Non logique

let userLoggedIn = true;
let userHasPremiumAccount = true;
let userHasMegaPremiumAccount = false;

userLoggedIn && userHasPremiumAccount; // affichera true
userLoggedIn && userHasMegaPremiumAccount; // affichera false

userLoggedIn || userHasMegaPremiumAccount; // true
userLoggedIn || userHasPremiumAccount; // true

!userLoggedIn; // false
!userHasMegaPremiumAccount; // true