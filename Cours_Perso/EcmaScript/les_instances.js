/*==============================================================================================================================*/
//                                                         LES INSTANCES
/*==============================================================================================================================*/

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
// on créer newAccount a partir une nouvelle instance de la classe BankAccount 
const newAccount = new BankAccount("Will Alexander", 500);
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