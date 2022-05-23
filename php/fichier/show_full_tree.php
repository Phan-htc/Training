<?php
// Définition du chemin à explorer
$homedir = '/';
// "ouverture" du répertoire
$dir = opendir($homedir);
// Récupération d'un pointeur sur le premier
// fichier (ou sous-répertoire) du répertoire grâce à readdir.
// Lorsque nous aurons atteint la fin de répertoire
// readdir retournera faux par conséquent
// la boucle s'arrêtera
function explore($homedir)
{         // La fonction d'exploration
    $dir = opendir($homedir);
    while ($file = readdir($dir)) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir("$homedir/$file")) { // c'est un répertoire
                explore("$homedir/$file");   // explorons le !
            } else {                       // c'est un fichier
                echo "$homedir/$file<br/>\n"; // affichons le !   
            }
        }
    }
    closedir($dir);
}
?>

<style>
    legend {
        background-color: yellowgreen;
        text-align: center;
    }

    fieldset {
        background-color: yellow;
    }

</style>

<form name="formulaire" action="#" method="post">
<fieldset>
<legend>répertoire à parcourir</legend>
<input type="text" name="dir" value="" />
<input type="submit" value="exécution"/>
</fieldset>
</form>