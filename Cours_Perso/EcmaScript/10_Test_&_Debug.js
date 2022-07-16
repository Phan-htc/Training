/*==============================================================================================================================*/
//                                               TEST ET DEBUG
/*==============================================================================================================================*/

/*
==============================================================
                        LES TESTS
==============================================================
Il existe 3 types de de tests à effectuer.
- les tests unitaires
- les tests d'intégration
- les tests fonctionnels (E2E)

Les tests unitaires se font qu'avec des cas simple puis un ou plusieurs cas limites.

Les tests d'intégration vérifie les fonctions multiples ou classes afin d'assurer qu'elles fonctionnent entre
elles. 
Par exemple, dans une fusée, 2 instruments de mesures fonctionne bien individuellement. 
Cependant si l'un fonctionne avec le systeme métrique et l'autre avec le systeme impérial, les données peuvent etre
éronnée et provoquer le crash de la fusée.

Les tests fonctionnels vérifient des scénario complets en contexte.
Par exemple, un utilisateur se connecte, ouvre ses notifications et les marque toutes comme lues. 
Ces tests vérifient aussi les ressources externes que votre projet peut utiliser, 
par exemple un système de paiement tiers.

Dans la pratique, on teste avec des outils tel que des frameworks de tests unitaire et fonctionnels comme 
Jasmine, mocha.js ou Mocha pour du Javascript par exemple.

==============================================================
                        Le Déboguage
==============================================================

Lorsque qu'on effectue des tests, il se peux qu'on se retrouve avec des bugs sous les bras.
pour cela on dispose de plusieurs outils tel qu'afficher dans la console ou les outils de développeurs qui sont 
intégrer dans les IDE.

Exemple */
const getWordCount = (stringToTest) => {
    const wordArray = stringToTest.split('');
    console.log("Word array in getWordCount: ");
    console.log(wordArray);
    return wordArray.length;
}
getWordCount('I am a fish')
/* la console montre :
"Word array in getWordCount:"
["I", " ", "a", "m", " ", "a", " ", "f", "i", "s", "h"]

Il s'avère que l'érreur viens de la fonction stringToTest.split('') qui devrait
etre écrit de cette manière stringToTest.split(' ').

Dans des cas très simple, la console est largement suffisante.
Cependant il arrive qu'on rencontre des bugs qui necessite plus de moyen pour être résolu.
Dans ces cas là on utilise les outils de developpeur qui sont présent dans les navigateurs tel que 
firefox, Chrome et safari.

il permet d'executer le code pas à pas avec des points d'arret.

DÉBUGGER avec son canard en plastique 
Lorsqu'on rencontre un probleme, expliquer le code a voix haute avec des termes simple et clair 
de tel sorte que le canard puisse comprendre permet de détecter plus rapidement la source du probleme
*/

