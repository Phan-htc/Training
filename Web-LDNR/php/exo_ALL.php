
<h1>exo 5</h1>
<p>Objectif : Écrire une boucle utilisant l'instruction while
Écrivez un script tel que celui ci :

produise des lignes préfixées par leur numéro en ordre inverse,
la première aura le numéro 100,
la dernière aura le numéro 0,
évitez de produire une ligne pour les valeurs finissant par 5 (95, 85, ... 15, 5),
le contrôle de la boucle se fera par while,
l'élimination des valeurs non désirées se fera à l'aide de l'instruction continue.</p>
<?php
    $ligne = 101;
    while ($ligne--) {
        if ($ligne%10 == 5) continue;
        echo "la fusée va se lancer dans $ligne secondes ! <br/>\n";
}
?>

<h1>exo 7: action sur les variables PHP</h1>
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

<h1>exo 1</h1>
<?php
    $var1 = 1;
    $var2 = 12.0;
    $var3 = "PHP";
    $var4 = false;
    $var5 = "5a";
    ?>
    <h1>exo 1 : Tableau des variables</h1>
    <table>
        <tr>
            <th>variable</th>
            <th>valeur</th>
            <th>Type</th>
        </tr>
        <tr>
            <td>$var1</td>
            <td><?php echo $var1; ?></td>
            <td><?php echo gettype($var1);?></td>
        </tr>
        <tr>
            <td>$var2</td>
            <td><?= $var2 ?></td>
            <td><?= gettype($var2)?></td>
        </tr>
        <tr>
            <td>$var3</td>
            <td><?php echo $var3; ?></td>
            <td><?php echo gettype($var3); ?></td>
        </tr>
        <tr>
            <td>$var4</td>
            <td><?php echo $var4; ?></td>
            <td><?php echo gettype($var4); ?></td>
        </tr>
        <tr>
            <td>$var5</td>
            <td><?php echo $var5; ?></td>
            <td><?php echo gettype($var5); ?></td>
        </tr>
    </table>
    <style>
        table, th, td {
            background-color: yellow;
            border : 1px black solid;
        }
    </style>