<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>Test le la lecture d'un fichier</title>
    <style type="text/css">
     body {font-family:sans-serif}
     h1 {color:#700;}
     samp {
         color:#FFF;
         background-color:#000;
         padding:0 1em;
         font-weight:bold;
     }
     code {
         color:#444;
         background-color:#FF8;
         padding:0 1em;
     }
    </style>
  </head>
  <body>
    <h1>Test de la lecture d'un fichier</h1>
    <?php
    $fname = './tmp/test.txt';
    $lig = 1;
    if ($fp = @fopen($fname, 'r')) {
      echo "<p>\n";
      while ($line = fgets($fp)) {
        // récupération des différentes portions de la ligne
        preg_match('/^(.*I)[[:space:]](0x[[:xdigit:]]+)[[:space:]]: (.).*$/u', $line, $regs);
        list($full, $ldeb, $ascii, $char) = $regs;
        printf("Ligne %03d : %s <code>%s</code> : <samp>%s</samp><br/>\n",
               $lig++,
               htmlspecialchars($ldeb),
               $ascii,
               htmlspecialchars($char)); // on se méfie des caractères spéciaux du XML qui sont : <>"'&
      }
      echo "</p>\n";
      fclose($fp);
    } else {
      printf('<p class="error">Le fichier <samp>%s</samp> ne peut pas être ouvert en lecture.</p>'."\n", $fname);
    }
    ?>
    <p>cette page ne peut être valide par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a> si elle tente d'afficher
      le caractère <em>ASCII</em> N°127 car celui-ci est <q>non imprimable</q>.</p>
  </body>
</html>