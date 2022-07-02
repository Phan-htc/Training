<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>Test de l'exploration récursive d'un répertoire</title>
    <style type="text/css">
     body {font-family: sans-serif}
     h1 {color:#700;}
     .error {color:#F00}
     samp {
       background-color:#444;
       color:#FF0;
     }
     samp.dir {
       background-color:#000;
       color:#F80;
     }
     samp.depth-dir {
       background-color:#400;
       color:#FF0;
     }
     samp.depth-dir::after {
       content:'...';
       background-color:#fcc;
       color:#F00;
 
     }
     fieldset label:last-of-type input {width:3em}
     .error {color:#F00}
    </style>
  </head>
  <body>
    <?php
 
    $submitted = isset($_REQUEST['dir']);
 
    // déclaration de la fonction récursive avec prototypage
    function listdir(string $cdir, int $depth):void {
      if (is_dir($cdir)) {
        if ($fh = @opendir($cdir)) {
          echo "<ul>\n";
          while (($file = readdir($fh)) !== false) {
            $filepath = $cdir . '/' . $file;
            if (!is_dir($filepath)) {
	      // ce n'est pas un répertoire donc on affiche son nom dans la style de base
              printf("<li><samp>%s</samp></li>", htmlspecialchars($filepath));
	    } elseif (strcmp($file, '.') != 0 && strcmp($file, '..') != 0) {
	      // on ne s'intéresse pas aux répertoires '.' et '..'
	      if ($depth == 0) {
		// répertoire trop profond, on le signale par le style
		printf('<li><samp class="depth-dir">%s</samp></li>', htmlspecialchars($filepath));
	      } else {
		// répertoire a explorer récursivement après avoir décrémenté la profondeur
		printf('<li><samp class="dir">%s</samp>', htmlspecialchars($filepath));
		listdir($filepath, $depth-1);
		echo "</li>\n";
              }
	    }
          }
          echo "</ul>\n";
          closedir($fh);
        } else { 
          printf('<p class="error">Le répertoire <em>%s</em> ne peut être ouvert en lecture.</p>'."\n", htmlspecialchars($cdir));
        }
      } else {
        printf('<p class="error">Le fichier <em>%s</em> ne correspond pas à un répertoire.</p>'."\n", htmlspecialchars($cdir));
      }
    }
 
    // si mode stric activé il faut IMPÉRATIVEMENT transmettre une entier à la fonction récursive
    $depth = $submitted && is_numeric($_REQUEST['depth']) ? (int)$_REQUEST['depth'] : 2;
 
    printf("<h1>Test de l'exploration récursive %s</h1>\n", $submitted ? "d'un répertoire" : 'du répertoire <samp>'.$depth.'</samp>');
    printf("<h3>profondeur maximale d'exploration : <em>%d</em></h3>\n", $depth);
 
    // génération du formulaire de selection répertoire et profondeur
    print('<form name="formulaire" action="#" method="get">'."\n");
    print("<fieldset>\n");
    print("<legend>répertoire à parcourir</legend>\n");
    // ci dessous usage de l'opérateur coalescent noté "??"
    printf('<label>Répertoire : <input type="text" name="dir" value="%s"/></label>'."<br/>\n", htmlspecialchars($_REQUEST['dir'] ?? ''));
    if ($submitted && !is_numeric($_REQUEST['depth'])) echo '<p class="error">la profondeur doit être un nombe entier.</p>'."\n";
    printf("<label>profondeur maximale d'exploration : ".'<input type="text" name="depth" value="%s"/></label>'."<br/>\n",
	   htmlspecialchars($_REQUEST['depth'] ?? ''));
    print('<input type="submit" value="exécution"/>'."\n");
    print("</fieldset>\n");
    print("</form>\n");
 
    if (isset($_REQUEST['dir'])) {
      listdir($_REQUEST['dir'], $depth);
    }
 
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>