<?php
$granola = 'mon_cookie';
$time = 10;
if (isset($_COOKIE[$granola])) {
  setcookie ($granola, "", time() - 10);                    # destruction 
} else {
  setcookie($granola, "petite faim ?", time()+$time); # création 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo_1</title>
</head>
<body>
<h1>Test simple des cookies</h1>
<?php
if (isset($_COOKIE[$granola])) {
  printf("la valeur du cookie $granola est : %s", $_COOKIE[$granola]);
} else {
  printf("nouveau cookie %s", $granola);
}
?>