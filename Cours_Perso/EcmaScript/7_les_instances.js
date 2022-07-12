/*==============================================================================================================================*/
//                                                    LES METHODES D'INSTANCES ET STATIQUE
/*==============================================================================================================================*/

//L'HERITAGE
//===========================================

// On créer la classe BankAccount
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
Les méthodes statiques sont différente des méthodes d'instances car 

*/