<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vérification des dates extrèmes. Affichage des dates</title>
  </head>
  <body>
    <h1>Vérification des dates extrèmes et affichage des dates</h1>
    <?php

    function my_strftime($format, $tstamp='') {
      if ($tstamp === '') $tstamp = time(); 
      if(stristr(PHP_OS,"win")) $format = utf8_decode($format);
      $res = strftime($format, $tstamp);
      if(stristr(PHP_OS,"win")) return utf8_encode($res);
      return $res;
    }

    if (setlocale(LC_TIME,'fr_FR.UTF-8', '')) {
      print("<h2>la localisation à France s'est déroulée normalement</h2>\n");
    } else {
      print("<h2 class=\"error\">la localisation à France a échoué, vous aurez les résultats probablement en <q>US English</q></h2>\n");
    }

    printf("La date la plus éloignée dans le passé et représentable en 32 bits est <strong>%s</strong><br/>\n",
	   my_strftime('%A %d %B %Y à %H:%M:%S',-2*1024*1024*1024));

    printf("La date la plus éloignée dans le futur et représentable en 32 bits est <strong>%s</strong><br/>\n",
	   my_strftime('%A %d %B %Y à %H:%M:%S',2*1024*1024*1024-1));

    $now = time();
    $date = my_strftime("%d-%m-%Y",$now);
    $heure = my_strftime("%H:%M",$now);

    $date2 = my_strftime("%A %d %B %Y",$now);
    $heure2 = my_strftime("%H:%M:%S",$now);

    print("Nous sommes le <strong>$date</strong> et il est <strong>$heure</strong>")."<br/>\n";
    echo "Nous sommes le <strong>".$date2."</strong> et il est <strong>".$heure2."</strong><br/>\n";
    echo "Nous sommes dans la semaine <strong>".my_strftime('%V')."</strong> <em>conformément à la norme ISO 8601:1988</em><br/>\n";
    echo "Le mois de <strong>".my_strftime("%B")."</strong> a <strong>".date("t")."</strong> jours et nous sommes le <strong>".date("z").
	 "<sup>ème</sup></strong> jour de l'année <strong>".date("Y")."</strong>\n";
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>