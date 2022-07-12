/*==============================================================================================================================*/
                                                        //LES TABLEAUX
/*==============================================================================================================================*/
// Array (EN) = Tableau (FR)

//on déclare les variables
let Price = "John Price";
let Soap = "John MacTavish";

//on déclare le tableau avec [] et ajouter les éléments voulu a l'intérieur des crochets
let TaskForce = ["John Price", "John MacTavish"];

//on peux ensuite accéder aux éléments du tableau par leur indice.
let capitaine = TaskForce[0]; // affichera John Price
let lieutenant = TaskForce[1]; // "John MacTavish"

// à noter que le premier indice dans un tableau est le 0

// comptage d'éléments avec la propriété length
let compositionTF = TaskForce.length; //affichera 2

//ajout ou suppression d'éléments
TaskForce.push("Simon Riley", "Gary Sanderson"); // ajoute au tableau avec push
TaskForce.unshift("Gary Sanderson"); // retire du tableau avec unshift
TaskForce.pop // retire le dernier élément du tableau sans passer aucun argument.