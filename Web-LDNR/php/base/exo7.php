<html>
    <head>
        <title>les variables PHP</title>
    </head>
    <body>
        <h1>action sur les variables PHP</h1>
<?php
$variable1 = "Bonjour";
$variable2 = 45 ;
--$variable2;
++$variable2;
++$variable2;
echo gettype($variable1). '<br/>';
echo gettype($variable2). '<br/>';
$variable3 = &$variable1;
$variable4 =  $variable2;
$variable1 .= " monsieur";
echo $variable1 . '<br/>';
echo $variable3 . '<br/>';
$variable2 *= 2 ;
echo $variable2 . '<br/>';
echo $variable4 .'<br/>';
?>
</body>
</html>