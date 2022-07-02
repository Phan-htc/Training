<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>les tableaux : Les fonctions next() key() et current()</title>
  </head>
 
  <body>
    <h1>les tableaux : La fonction <samp>next()</samp></h1>
    <?php
    $noms = ["Louis", "Léon", "Hector", "Julie", "Marie", "Géraldine"];
    printf("<p>Premier élément par l'indice 0 : <q>%s</q></p>\n", $noms[0]);
    print("<p>Tableau complet par fonction <samp>next()</samp></p>\n<ul>\n");
    while ($val = current($noms)) {
      $key = key($noms);
      printf("<li>élément %s =&gt; <q>%s</q></li>\n", $key, $val);
      next($noms);
    }
    print("</ul>\n");
    reset($noms);
 
    printf("<p>Premier élément par la fonction <samp>current()</samp> : <q>%s</q></p>\n", current($noms));
    print("<p>Affichage du tableau complet par la fonction <samp>print_r()</samp> :</p>\n");
    print('<pre>');
    print_r($noms);
    print("</pre>\n");
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>