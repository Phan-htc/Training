<?php
require_once('../access.php');

// ouvre une connexion sur le système MySQL de la machine locale,
$dbm = new PDO('mysql:host=localhost; dbname=geo_france','test', 'toto');
exec("SET NAMES 'utf-8'");
// ouvre une connexion sur le système SQLITE utilisant le fichier geo_france.sqlite
$dbs = new PDO('sqlite:/home/stag/geo_france.sqlite');
// affiche par une requête à SQL le contenu le la table region présente sur le système MySQL,
$reqMySQL ='SELECT * FROM region';
// affiche par une requête à SQL le contenu le la table departements présente sur le système SQLITE
$reqsqlite = 'SELECT * FROM departements';

// Le rendu de chaque table se fera sous forme de tableau HTML. 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Double BDD</title>
</head>
<body>
<h1>Double table</h1>  
<table>
  <!-- génération d'un tableau de type associatif-->
  <tr>
    <th>Région</th>
    <th>Département</th>
  </tr>

  <?php 
  //pour chaque itération du tableau région et département
  ?>
</table>
</body>
</html>