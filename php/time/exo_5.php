<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test de validité de date</title>
    <style type="text/css">
     .error {color:red}
    </style>
  </head>
  <body>
    <?php
    //------------------------------------------------------------------
    // fonction permettant de transformer une date JJ/MM/YYYY en YYYY-MM-JJ
    function date_to_sql($date){
      list($jour, $mois, $annee) = explode('/', $date);
      return "$annee-$mois-$jour";
    }
    //------------------------------------------------------------------
    // fonction permettant de transformer une date YYYY-MM-JJ en JJ/MM/YYYY
    function date_to_fr($date){
      list($annee, $mois, $jour) = explode('-', $date); 
      return "$jour/$mois/$annee";
    }

    // récupération de la date au format SQL
    $date_sql = date('Y-m-d');
    printf("<p>La date en format en <em>SQL</em> : <samp>%s</samp> est en donnée ainsi en français : <samp>%s</samp></p>\n", $date_sql, date_to_fr($date_sql));

    // récupération de la date au format français
    $date_fr = date('d/m/Y');
    printf("<p>Date en français : <samp>%s</samp> est en donnée ainsi en format en <em>SQL</em> : <samp>%s</samp></p>\n", $date_fr, date_to_sql($date_fr));
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>