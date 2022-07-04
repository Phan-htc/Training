/*==============================================================================================================================*/
                                                        //LES BASES
/*==============================================================================================================================*/

/*
JavaScript est sensible à la casse et c'est un langage avec une syntaxe dynamique
Chaque fin d'instruction doit se terminer par un ;
*/
//                                                      LES VARIABLES
var unNombre = 1234;    // On déclare une variable, éventuellement en initialisant sa valeur.
var unType = string     // on peux déclarer une variable en indiquant son type.
let bonjour ;           // Déclare une variable dont la portée est celle du bloc courant.
const MaConstante = 5 ; // Déclare une constante dont la portée est celle du bloc courant, accessible en lecture seule.

// il y a 3 types primitifs de variable : number, string ( chaine de caractère ), booléan ( Valeur logique(Vrai ou Faux)).

let nom = "Sparrow";
let prenom = "Jack";
let protagoniste = prenom +" "+ nom; // affichera Jack Sparrow car il y a une concataination avec +, on met un espace avec " " et on concataine.

// Une variable déclarée sans valeur initial vaudra "undefined"
// Acceder a une variable non déclarée ou avant son initialisation a un identifiant déclaré avec let 
//      provoquera une exception "ReferenceError"
// Un identifiant javascript accepte uniquement les caractère alphanumérique, les _ et $.

// les nom des Constante se font en camel case (EX: finalAnswer, numberOfCats)
// Il est préférable d'avoir des noms de variable qui soit comprehensible et cohérent pour la compréhension et la maintenance

unNombre = 56789; // on réaffecte une valeur a une variable.

//                                                      LES OPERATEURS
// addition +
let cookiesInitial = 10;
let cookieAdd = 2;
let cookieResultAddition = cookiesInitial + cookieAdd;

// soustraction-
let pouletInitial = 10;
let pouletRemove = 2;
let barquettePoulet = pouletInitial - pouletRemove;

// +=,-= ajoute ou soustrait un nombre d'une variable
let nombreDeFrite = 100;
nombreDeFrite -= 50; // affichera ln résultat 50 car il soustrait et affiche le résultat
nombreDeFrite += 30; // affichera le resultat 80 

// l'incrémentation ++
let nuggets = 10;
nuggets++; // affichera 11 car on a ajouter un nuggets par rapport a l'initialisation

// décrémentation --
nuggets-- // affichera 10 car on a retirer un nuggets du résultat précédent 

// multiplication *
let portions = 50;
let clients = 30;
let nombreDeCommandes = clients * portions;

// division /
let partDePizza = 10;
let nombreDePersonnes = 5;
let nombreDePartParPersonne = partDePizza / nombreDePersonnes;

// *=, /= multiplie ou divise une variable 
let reserveDeBilles = 4000;
let nombreDeJoueurs = 10;
let nombreDeBilleParJoueur = reserveDeBilles / nombreDeJoueurs; // affichera 400
let chacunSonPaquet = reserveDeBilles * nombreDeJoueurs;        // affichera 40 000