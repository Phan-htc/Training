<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Liste des bases de données MySQL sur la machine locale</title>
  </head>
 
  <body>
    <h1>Liste des bases de données <em>MySQL</em> sur la machine locale</h1>
    <?php
    require_once('../access.php');  // chargement des identifiants
 
    // cette requête est conforme au standard SQL
    $req = 'SELECT schema_name FROM information_schema.schemata';
 
    try {
      $dbh = new PDO('mysql:host='.$host, $user, $pwd);  # Dans ce cas sous MySQL inutile de se connecter sur une base de données
    } catch (PDOException $myexep) {
      die(sprintf('<p class="error">la connexion à la base de données à été refusée <em>%s</em></p>'.
		  "\n", htmlspecialchars($myexep->getMessage())));
    }
 
    echo "Connecté\n";
    if ($res = $dbh->query($req)) {
      echo "<ol>\n";
      while ($val = $res->fetchColumn()) {
	echo "<li>$val</li>\n";
      }
      echo "</ol>\n";
    } else {
      printf("<p>La requête <samp>%s</samp> n'a pu aboutir</p>\n", $request);
    }
 
    // fermeture de connexion
    unset($dbh);
    ?>
  </body>
</html>