<?php
/*==============================================================================================================================*/
                                                        //LES BASES
/*==============================================================================================================================*/

//Variables se déclarent avec $ et ils sont sensible à la casse ( Var != var )
// il y a 4 type scalaire ( bool / int / float / string )
// 4 types composés ( array / object / callable / iterable)
// 2 type spéciaux ( resource / NULL)

// LES TABLEAUX  peut être créé en utilisant la structure de langage array(). 
// Il prend un nombre illimité de paramètres, chacun séparé par une virgule, sous la forme d'une paire key => value.

array(
    "key" => "value",
    "key" => "value",
);

// Condition permettent d'éxécuter un code en fonction d'une condition et peuvent s'écrire de plusieurs façons.
if ($a > $b) {
    echo "a est plus grand que b";
} elseif ($a == $b) {
    echo "a est égal à b";
} else {
    echo "a est plus petit que b";
}

//switch permettent d'effectuer une opération en fonction de la valeur prise par une variable.
switch ($i) {
    case 0:
        echo "i égal 0";
        break;
    case 1:
        echo "i égal 1";
        break;
    case 2:
        echo "i égal 2";
        break;
}

// Boucle while: effectuer une opération jusqu'à la complétion d'une condition (attention aux boucles infinies).
$i = 1;
while ($i <= 10) {
    echo $i = $i + 1; // penser toujours à la condition de sortie              (attention aux boucles infinies).
}

// Boucle for:  idéal si on connait le nombre d'itération à effectuer
for ($i = 1; $i <= 10; $i++) {
    echo $i;
}

// foreach permet de parcourir l'ensemble des éléments d'un tableau
foreach ($tableau as $valeur){
    // du code
}
foreach ($tableau as $clef => $valeur){
    // du code
}

/** LES FONCTIONS
 * PHP possède de nombreux fonction qui sont consultable sur php.net
 * cependant se peux qu'on soit obliger de développer nous meme notre propre fonction.
 * Les noms des fonctions sont composé uniquement de caractère alphanumerique et des underscore
 * ATTENTION - Pensez à vérifier la compatibilité avec la version de php
 */

function nom_de_fonction (string $param1, string $param2 = "valeur par défaut"): string
{
    return "Valeur de retour";
}

include '';         // inclus dans ce fichier un code venant d'un autre fichier
include_once '';    // Similaire a include mais si le code a deja été inclus, il ne le sera pas une seconde fois
                    // si il y a une erreur, include produit un warning et le script peux continuer a s'exécuter

require '';         // Similaire a include mais lorsqu'une erreur survient, produit une erreur fatal
require_once '';    // Similaire a require mais si le code a deja été inclus, il ne le sera pas une seconde fois

/*==============================================================================================================================*/
                                                        //LES FORMULAIRE
/*==============================================================================================================================*/
?>
<!--                                   RÈGLE ABSOLUE ET IMMUABLE CONCERNANT LES FORMULAIRES
                                Ne jamais faire confiances aux données envoyé par l'utilisateur
-->

<form action="#" method="GET"> <!--action envoie les données du formulaire vers le fichier qui va les traiter
                                # indique que le fichier de traitement est lui même
                                les méthodes d'envoie sont soit en GET soit en POST, si rien n'est indiqué, la 
                                méthode par défaut est GET -->
    <input type="text" name="exemple_name" placeholder="exemple de nom" value="<?= htmlentities($_GET['exemple_name'])?>">
    <!-- 
        htmlentities convertit tous les caractères en entités HTML
        On peux aussi utiliser htmlspecialchars qui convertit les caractères spéciaux en entités HTML
            Cela est une protection contre l'injection de code
    -->
    <input type="number" name ="exemple_number">
    <button type="submit">Valider</button>
</form>
