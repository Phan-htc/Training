<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>Test de l'exploration récursive d'un répertoire</title>
    <style type="text/css">
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
    </style>
  </head>
  <body>
    <?php

    printf("<h1>Test de l'exploration récursive %s</h1>\n",
           empty($_REQUEST['dir']) ? "d'un répertoire" : 'du répertoire <samp>'.htmlspecialchars($_REQUEST['dir']).'</samp>');

    function listdir($cdir) {
      if (is_dir($cdir)) {
        if ($fh = @opendir($cdir)) {
          echo "<ul>\n";
          while (($file = readdir($fh)) !== false) {
            $filepath = $cdir . '/' . $file;
            if (is_dir($filepath)) $class = ' class="dir"'; else $class = '';  // pour donner un style aux répertoires
            printf("<li><samp%s>%s</samp>", $class, htmlspecialchars($filepath));
            if (is_dir($filepath) && strcmp($file, '.') != 0 && strcmp($file, '..') != 0) {
              listdir($filepath);
            }
            echo "</li>\n";
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
    
    print('<form name="formulaire" action="#" method="get">'."\n");
    print("<fieldset>\n");
    print("<legend>répertoire à parcourir</legend>\n");
    // ci dessous usage de l'opérateur coalescent noté "??"
    printf('<input type="text" name="dir" value="%s" />'."\n", htmlspecialchars($_REQUEST['dir'] ?? ''));
    print('<input type="submit" value="exécution"/>'."\n");
    print("</fieldset>\n");
    print("</form>\n");
    if (isset($_REQUEST['dir'])) {
      listdir($_REQUEST['dir']);
    }

    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>