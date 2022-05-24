<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Résultat de la conversion</title>
    <style type="text/css">
     .error {color:red}
    </style>
    <script type="text/javascript">
     function giveFocus() {
       elmt = document.getElementById('date');
       elmt.focus();
     }
    </script>
  </head>
  <body onload="giveFocus();">
 <?php
 if (isset($_GET['date'])) {
 
   $day_length = 3600*24;
   $strg = $_GET['date'];
   printf("<h1>Vérification du nombre de jours écoulés depuis le <em>%s</em></h1>\n", htmlspecialchars($strg));
   if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{2}|\d{4})$#', $strg, $res)) {
     $day = $res[1];
     $month = $res[2];
     $year = $res[3];
     if ($year < 100) $year += 1900;
     $dday  = intval(mktime(12,0,0,$month,$day,$year)/$day_length);
     $today = intval(time()/$day_length);
     if ($today < $dday) {
       printf("<h2>le <strong>%s</strong> sera dans <em>%d</em> jours.</h2>\n", $strg, $dday-$today);
     } elseif ($today > $dday) {
       printf("<h2>le <strong>%s</strong> c'était il y a <em>%d</em> jours.</h2>\n", $strg, $today-$dday);
     } else {
       printf("<h2>le <strong>%s</strong> c'est aujourd'hui\n", $strg);
     }
   } else {
     printf("<h3 class=\"error\">la date <em>%s</em> est invalide, elle doit être de la forme <em>JJ/MM/AAAA</em></h3>", $strg);
   }
   print("<h2>Saisissez une nouvelle date</h2>\n");
 } else {
   $strg = '';
   print("<h1>Saisissez une date</h1>\n");
 }
 ?>
    <form action="#" method="get">
      <label>date <?php printf('<input type="text" name="date" id="date" size="60" value="%s"/>', $strg); ?></p>
      <input type="submit" name="envoyer" value="envoyer" />
    </form>

  </body>
</html>