<?php
if (isset($_COOKIE['compteur'])) {
  $comp = $_COOKIE['compteur'] + 1;
} else {
  $comp = 0;
}
setcookie("compteur", $val, time()+10);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compteur</title>
</head>
<body>
<h1>Test de compteur des accès par cookies</h1>
<?php
printf("<h2>Il y a <em>%d</em> visites sur ce site.</h2>\n", $val);
?>
</body>
</html>