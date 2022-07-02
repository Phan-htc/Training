<?php
$a = "Bonjour à toutes et à tous, aujourd'hui le programe est PHP. 
Demain il en sera de même";

echo substr($a, 0,7)."<br/>\n";
echo substr($a, 12, 4)."<br/>";
echo substr($a, 9, 10)."<br/>";//
echo substr($a, 9, 1)."<br/>";//

printf($a%c, 9, 1);


/*solution
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>affichage de caractères spéciaux.</title>
  </head>
  <body>
    <h1>affichage de caractères spéciaux.</h1>
    <?php
    $a = "Bonjour à toutes et à tous, aujourd'hui le programme est PHP. Demain il en sera de même";
    $i = 1;
    $format = "%02d - <samp>%s</samp><br/>\n";
    mb_internal_encoding('UTF-8'); // par défaut à partir de PHP7
    printf($format, $i++, substr($a, 0, 7));
    printf($format, $i++, substr($a, 11, 5));
    printf($format, $i++, substr($a, 8, 1));
    printf($format, $i++, substr($a, 9, 1));
    printf($format, $i++, substr($a, 8, 2));
    printf($format, $i++, substr($a, -10));
    printf($format, $i++, substr($a, -15, 5));
    printf($format, $i++, mb_substr($a, 8, 1));
    printf("Longueur de la chaîne en octets : %d<br/>\n", strlen($a));
    printf("Longueur de la chaîne en caractères : %d<br/>\n", mb_strlen($a));
    ?>
    <p>pages validées par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>
*/