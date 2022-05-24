<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Temps écoulé depuis 1970</title>
</head>  
  <body>
    <h1>Temps écoulé depuis 1970</h1>
    <?php

    $nbsec = time();
    $remain_days = (0x80000000 - 1 - $nbsec)/(24*3600);
    printf("<p>Il s'est écoulé %d secondes depuis le 1er Janvier 1970</p>\n", $nbsec);
    printf("<p>Il reste %d jours avant la fin des temps ...</p>", $remain_days);
    ?>
  </body>
</html>