<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
  </head>
  <body>
    <h1>Test des sessions</h1>
    <?php

    $cpt = $_SESSION['compteur'] ?? 1; 

    $id_session  = session_id();
    $session_name = session_name();
    if (isset($_SESSION['temps'])){
      $diff_time = time() - $_SESSION['temps'];

      printf("<p>Temps écoulé depuis le dernier passage : <strong>%s</strong> secondes</p>", $diff_time);
      if ($diff_time > 30) {
	printf("<h2>Durée de session (id = %s) dépassée !</h2>", $id_de_session);
	printf("<h3><a href=\"%s\">Recommencer une session</a></h3>", $_SERVER["SCRIPT_NAME"]);
	session_destroy();
	exit();
      }
      printf("<h3>passage numéro <em>%d</em> dans la session %s(%s)</h3>", $cpt, $session_name, $id_session);
    } else {
      printf("<h3>vous entrez dans une nouvelle session %s = %s</h3>", $session_name, $id_session);
    }
    $_SESSION['compteur']=$cpt+1;
    $_SESSION['temps'] = time();

    if (isset($_POST['fin_session'])) {
      print ("<h2 class=\"destroy\">Session volontairement détruite !</h2>");
      printf("<h3><a href=\"%s\">Recommencer une session</a></h3>", $_SERVER["SCRIPT_NAME"]);
      session_destroy();
      exit();
    }

    print ('<form action="#" method="post"><fieldset><legend>Envoi de valeurs</legend>');
    foreach(['nom', 'prenom', 'age'] as $val) {
      if (isset($_POST[$val])) $_SESSION[$val] = $_POST[$val]; 
      // ci-dessous utilisation de l'opérateur coalescent '??'
      printf('<label>%s :<input type="text" name="%s" value="%s"/></label>',
             ucfirst($val),  $val, $_SESSION[$val] ?? '');
    }
    print('<p><input type="submit" value="envoyer" />');
    print('<input type="submit" class="destroy" name="fin_session" value="terminer la session" /></p>');
    print("</fieldset></form>");
    ?>
  </body>
</html>