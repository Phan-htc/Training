/*==============================================================================================================================*/
//                                               OPTIMISATION DU CODE
/*==============================================================================================================================*/

/*
Lorsqu'on code, il est très important de rendre le code le plus propre et le plus court possible, tout en ayant
les fonctionnalitées.

- DRY ( Don't Repeat Yourself)
    un code qui se répète est plus lourd et plus chronophage pour la maintenance.
    si il y a une répétition, il est préférable de le factoriser dans une fonction.
    
- Commenter son code
    Commenter son code rend le code plus compréhensif pour la maintenance ou la relecture après plusieurs mois
    d'abscence.
    ne commentez pas toutes les lignes, les commentaires doivent juste clarifier ce qui n'est pas apparent à
    la lecture

- Utilisez les conventions de nommage

- Mettez en forme votre code
    - mise en retrait
    - Espacement
    - Positionnement des accolades

 */

// Code mal optimisé et répétitif
if (firstUser.online) {
    if (firstUser.accountType === "normal") {
        console.log("Hello " + firstUser.name + "!");
    } else {
        console.log("Welcome back premium user " + firstUser.name + "!");
    }

}
if (secondUser.online) {
    if (secondUser.accountType === "normal") {
        console.log("Hello " + secondUser.name + "!");
    } else {
        console.log("Welcome back premium user " + secondUser.name + "!");
    }
}

if (thirdUser.online) {
    if (thirdUser.accountType === "normal") {
        console.log("Hello " + thirdUser.name + "!");
    } else {
        console.log("Welcome back premium user " + thirdUser.name + "!");
    }
}


// le même code factorisé 
const sendWelcomeMessageToUser = (user) => {
    if (user.online) {
    if (user.accountType === "normal") {
           console.log("Hello " + user.name + "!");
    } else {
          console.log("Welcome back premium user " + user.name + "!");
    }
    }
    }
    
    sendWelcomeMessageToUser(firstUser);
    
    sendWelcomeMessageToUser(secondUser);
    
    sendWelcomeMessageToUser(thirdUser);