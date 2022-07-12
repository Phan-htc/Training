/*==============================================================================================================================*/
//                                                   LA GESTION D'ERREURS
/*==============================================================================================================================*/

/* Les principaux sources d'erreurs viennent souvent de 3 types d'érreurs 
- Les erreurs de syntaxe tel que des fautes d'orthographe, crochets manquants, nombre de guillemets incorrect, etc...

- Les erreurs logiques – erreurs dans l'application du déroulement du programme, par exemple erreurs dans les conditions des instructions  
if ou oubli d'incrémentation de l'indice d'une boucle, pouvant potentiellement conduire à une boucle infinie.

- les erreurs d'execution causé par des ressouces externes comme le réseau, base de donnée ou les utilisateurs.
dans ce cas là, on utilise un bloc de traitement des erreurs try/catch.
il est similaire a un if/else, mais il n'est pas adéquat pour traiter des erreurs.
il essaye le bloc d'instruction, si il trouve une erreur, il "attrape" l'erreur/exception et execute l'instruction qu'on a défini 
pour les erreurs 
 */
try {
    // code susceptible à l'erreur ici
    } catch (error) {
    // réaction aux erreurs ici
    }