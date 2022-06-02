<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Affichage du contenu d'une session</title>
  <style type="text/css">
    h1 {
      color: #700;
    }

    cite {
      color: #FFF;
      background-color: #888;
      padding: 0 1em;
      font-weight: bold;
    }
  </style>
</head>


<body>
  <h1>Affichage du contenu d'une session</h1>
  <?php
  if (count($_SESSION)) {
    printf("<h3>la variable de session est <samp>%s</samp></h3>\n", session_name());
    printf("<h2>identité de la session <em>%s</em></h2>\n", session_id());
    foreach ($_SESSION as $key => $val) {
      if (is_array($val)) {
        printf("<p>le paramètre <em>%s</em> est égal à <pre>%s</pre></p>\n", $key, htmlspecialchars(print_r($val, true)));
      } else {
        printf("<p>le paramètre <em>%s</em> est égal à <code>%s</code></p>\n", $key, htmlspecialchars($val));
      }
    }
    if (!isset($_SESSION['cpt'])) $_SESSION['cpt'] = 0;//si le cpt de $session n'est pas init; cpt = 0

    // insertion de l'adresse IP dans un tableau
    if (!isset($_SESSION['ips'])) $_SESSION['ips'] = [];
    $_SESSION['ips'][] = $_SERVER['REMOTE_ADDR']; //$_SERVER['REMOTE_ADDR'] = adresse IP du client

    // destruction de session au delà de la dixième itération
    if ($_SESSION['cpt']++ == 10) session_destroy();
  } else {
    printf("<h2>La session <em>%s</em> n'existe pas, créons-la !</h2>\n", session_id());
    $_SESSION['cpt'] = 0;
  }
  ?>

</body>

</html>