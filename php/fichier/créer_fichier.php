<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>Test de l'écriture d'un fichier</title>
    <style type="text/css">
     body {font-family:sans-serif}
     h1 {color:#700}
     p.error {
         color:#FAA;
         background-color:#000;
     }
     samp {
         color:#FFF;
         background-color:#000;
         padding:0 1em;
         font-weight:bold;
     }
    </style>
  </head>
  <body>
    <h1>Test de l'écriture d'un fichier</h1>
    <?php
    $fname = './tmp/test.txt';
    $lig = 1;
    if ($fh = @fopen($fname, 'w')) { // créer un fichier et donne la permission d'écriture
      for ($n=0x20; $n<0x80; $n++) { // hexadécimale 0x20 = 32, 0x80 = 127
        fprintf($fh, "Code ASCII 0x%02x : %c\n", $n, $n); // $n affiche le code ascii
      }
      fclose($fh);
      printf('<p>Voir le résultat <a href="%s">ici</a></p>'."\n", $fname);
    } else {
      printf('<p class="error">Le fichier <samp>%s</samp> ne peut pas être ouvert en écriture.</p>'."\n", $fname);
    }
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>