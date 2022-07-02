<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>TP PHP/MySQL : Affichage réponse à requête MySQL</title>
</head>

<body>
  <h1>Affichage réponse à requête MySQL</h1>
  <?php

  print('<form name="formulaire" action="#" method="post">'."\n");
  // Affiche un tableau où 'variable_du_champ' => 'nom_du_champ'
  $input_array = array('host'       => 'machine hébergeant la base de données',
                       'dbname'     => 'nom de la base de données',
                       'user'       => 'utilisateur',
                       'password'   => 'mot de passe',
                       'search_sql' => 'expression <em>SQL</em>');

  foreach($input_array as $itm => $cmt) {
    $type = ($itm == 'password') ? 'password' : 'text';
    $post = $_POST[$itm] ?? ''; # ne fonctionne que sous PHP7 ou +
    printf('<fieldset><legend>%s</legend><input type="%s" name="%s" value="%s"/></fieldset>'."\n", $cmt, $type, $itm, $post);
  }

  print('<input type="submit" value="exécution"/>'."\n</form>\n");

  try {
    if (isset($_POST['host'])) {
      $dbh = new PDO('mysql:host='.$_POST['host'].';dbname='.$_POST['dbname'].'; charset=UTF8',
                     $_POST['user'],$_POST['password']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      echo "Connecté<br/>\n";
      
      $res = $dbh->query($_POST['search_sql']);
      printf("il y a %s lignes.<br/>\n", $res->rowCount());
      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
	echo "<ol>\n";
	foreach($row as $key => $val) {
	  echo "<li>$key => $val</li>\n";
	}
	echo "</ol>\n";
      }
      unset($dbh);
    }
  } catch (PDOException $myexep) {
    printf('<p class="error">Problème avec la base de données <em>%s</em></p>'."\n", $myexep->getMessage());
  } catch (exception $myexep) {
    printf('<p class="error">Autre problème <em>%s</em></p>'."\n", $myexep->getMessage());
  }

  ?>
  <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
</body>
</html>