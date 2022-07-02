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
    if (isset($_GET['date'])) {

      $strg = $_GET['date'];
      printf("<h1>Vérification de la validité de la date <em>%s</em></h1>\n", htmlspecialchars($strg));
      if (preg_match('#^(\d{1,2})([/-])(\d{1,2})\2(\d{2}|\d{4})(\s(\d{1,2}):(\d{1,2}):(\d{1,2}))?$#', $strg, $res)) {
	$day = $res[1];
	$month = $res[3];
	$year = $res[4];
	if (count($res) == 9) {
          print("<h3>Vérification complète (avec l'heure)</h3>\n");
          $hour = $res[6];
          $min = $res[7];
          $sec = $res[8];
	} else {
          print("<h3>Vérification partielle (sans l'heure)</h3>\n");
          $hour = $min = $sec = 0;
	}
	if ($year < 100) $year += 1900;
	if (checkdate($month, $day, $year) && $hour < 24 && $min < 60 && $sec < 60) {
          if (!setlocale(LC_TIME,"fr_FR.UTF-8")) {
            print("<h2 class=\"error\">la localisation à France a échoué</h2>\n");
	    if (setlocale(LC_ALL,'')) {
	      print("<h2>Localisation à France (<em>windows</em>) réussie.</h2>\n");
	    } else {
	      print("<h2 class=\"error\">la localisation à France a échoué</h2>\n");
	    }
          }
	  $time = mktime($hour,$min,$sec,$month,$day,$year);
          printf("<h2>le <strong>%s</strong> est bien conforme à une date !</h2>\n",
                 strftime("%A %d %B %Y à %H:%M:%S", $time));
	} else {
          printf("<h3 class=\"error\">Malgré les apparences, la date <em>%s</em> est invalide</h3>", $strg);
	}
      } else {
	printf("<h3 class=\"error\">la date <em>%s</em> est invalide, elle doit être de la forme <em>JJ/MM/AAAA HH:MM:SS</em></h3>", htmlspecialchars($strg));
      }
      print("<h2>Saisissez une nouvelle date</h2>\n");
    } else {
      print("<h1>Saisissez une date</h1>\n");
      $strg = '';
    }
    ?>
    <form action="#" method="get">
      <p>date <?php printf('<input type="text" name="date" id="date" size="60" value="%s" autofocus=""/>', $strg); ?></p>
      <input type="submit" name="envoyer" value="envoyer" />
    </form>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>