/*==============================================================================================================================*/
                                                        //LES OBJETS
/*==============================================================================================================================*/

// En javascript, les objets se font avec des fichier json (JavaScript Object Notation)
// Ces fichiers ne gèrent pas les commentaires

let Voiture = {                     // On déclare l'objet' Voiture
    marque :'koenigsegg',           // On déclrare ses attributs en séparant chaque attribut par une ,
    modele :'Gemera',
    puissance :1500 ,
    motorisation: 'hybride',
    existant: true
};

//Notation pointée
let voitureMarque = Voiture.marque; //accées aux donnée de l'objet Voiture en cherchant la marque 

// notation bracket
let voitureModele = Voiture["modele"]; // affiche Gemera
//L'intérêt ici c’est qu’on va pouvoir mettre entre bracket une variable qui contient en string le nom de la propriété que l’on souhaite atteindre.

// on peux avoir besoin de plusieurs objets du meme type, pour cela on utilise les classes

class Arme {                                        // Déclaration d'une classe
    constructor(fabriquant, modele, calibre) {      // constructor indique les propriété auquel la classe est constitué
    this.fabriquant = fabriquant;                   // this est un mot clé qui accède a la propriété
    this.modele = modele;
    this.calibre = calibre;
    }
}
/* l'héritage
l'héritage est un principe ou toute objet qui hérite d'une class, contient toutes les propriété auquel
la classe mère possède.
pour créer un objet qui hérite d'une classe, on doit créer une instance.
=============================================================================================================
                                    A SUIVRE AU PROCHAIN COURS SUR LES INSTANCES
=============================================================================================================
*/