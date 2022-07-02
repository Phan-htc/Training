<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Programmation Web avec PHP : Manipulation des dates</title>
  </head>
  <body>
    <h1>différence entre deux dates</h1>

<?php
$input_format = <<<ENTREE
<fieldset>
  <label>Saisir la date numéro %d</label>
  <input type="date" name="date%d" value="%s"/>
</fieldset>
ENTREE;

$form_format = <<<FORM
<form>
%s
<input type="submit" value="calcule la Différence"/>
</form>
FORM;

$failed = false;
$input = '';
for ($i = 1; $i <= 2; $i++) {
  $date[$i] = $_GET['date'.$i] ?? '';
  // production du HTML d'une saisie de date
  $input .= sprintf($input_format, $i, $i, $date[$i]);
  if ($date[$i]) {
    list($an, $mois, $jour) = explode('-',$date[$i]);
    $tstamp[$i] = mktime(0, 0, 0, $mois, $jour, $an);
  }
}

printf($form_format, $input);

echo ("<h3>\n");
if ($tstamp[1] && $tstamp[2]) {
  $nbJour = ($tstamp[2] - $tstamp[1]) / (60*60*24);
  printf("Différence de jours entre les 2 dates : %d jour(s)\n", $nbJour);
} elseif ($failed) {  // traitement des erreurs
  print("REMPLISSEZ TOUS LES CHAMPS DU FORMULAIRE CI DESSUS AVEC UNE DATE VALIDE !");
} else {
  print("Remplissez tous les champs du formulaire ci dessus.");
}
echo ("</h3>\n");
?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>