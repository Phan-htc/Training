<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</html>
    <h1>Affichage du contenu d'une session</h1>
    <?php
    if (count($_SESSION)) {
      printf("<h3>la variable de session est <samp>%s</samp></h3>\n", session_name());
      printf("<h2>identité de la session <em>%s</em></h2>\n", session_id());
      foreach($_SESSION as $key => $val) {
	printf("<p>le paramètre <em>%s</em> est égal à <strong>%s</strong></p>\n", $key, $val);
      }
      if (!isset($_SESSION['cpt'])) $_SESSION['cpt'] = 0;

      // destruction de session au delà de la dixième itération
      if ($_SESSION['cpt']++ == 10) session_destroy();
    } else {
      printf("<h2>La session <em>%s</em> n'existe pas, créons-la !</h2>\n", session_id());
      $_SESSION['cpt'] = 0;
    }
    ?>
  </body>
</html>