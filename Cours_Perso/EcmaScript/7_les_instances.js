/*==============================================================================================================================*/
//                                                    LES METHODES D'INSTANCES ET STATIQUE
/*==============================================================================================================================*/
class BankAccount {
    constructor(owner, balance) {
       this.owner = owner;
       this.balance = balance;
    }
    showBalance() {
      console.log("Solde: " + this.balance + " EUR"); // fonction qui affiche dans la console le solde du compte
   }
 }

// Grace à l'héritage, les instances qu'on déclare avec new possèdent les propriétés et attibuts de la classe
// auquel il hérite 
// new est un mot clé qui indique une nouvelle instance 
const newAccount = new BankAccount("Will Alexander", 500);  // newAccount est une instance qui hérite les propriété 
                                                            // de la classe BankAccount
// Une instance de classe est également un objet


class CompteBancaire {
    constructor(proprietaire, solde) {
       this.proprietaire = proprietaire;                
       this.solde = solde;
    }
    showBalance() {                                     // fonction perso
       console.log("Solde: " + this.solde + " EUR");    // affiche dans la console 
    }
    showBalance() {
        console.log("Solde: " + this.solde + " EUR");
    }
    
    depot(amount) {
        console.log("Dépôt de " + amount + " EUR");
        this.solde += amount;
        this.showBalance();
    }
    
    retrait(amount) {
        if (amount > this.solde) {
                 console.log("Retrait refusé !");
        } else {
            console.log("Retrait de " + amount + " EUR");
            this.solde -= amount;
            this.showBalance();
        }
    }
 
}
//===============================================================

// LES METHODES STATIQUES

/*
Les méthodes statiques sont différente des méthodes d'instances car elle n'est pas lié a une instance, mais à
la classe elle même.
elles sont utilisé pour créer des méthodes utilitaire ( helper en anglais )
par exemple nous avons la méthode Math qui contiens beaucoup de fonctionnalité de base.
*/
const randomNumber = Math.random();// créer un nombre aléatoire entre 0 et 1
const roundMeDown = Math.floor(495.966); // arrondit vers le bas à l'entier le plus proche, renvoie 495
// grace au mot clé ( static ), on peux créer nos propre méthodes statiques.
class BePolite {
    
    static sayHello() {
        console.log("Hello!");              //affiche un message générique
    }
    
    static sayHelloTo(name) {
        console.log("Hello " + name + "!"); // prend en argument pour créer un message
    }
    
    static add(firstNumber, secondNumber) { 
        return firstNumber + secondNumber;  // renvoie la valeur à partir des arguments reçu
    }
}

BePolite.sayHello(); // affiche "Hello!""

BePolite.sayHelloTo("Will"); // affiche "Hello Will!""

/*
Pas besoin de constructor car on ne va pas l'instancier */