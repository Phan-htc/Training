<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Exo_1</title>
  </head>
    <?php
    $var1 = 1;
    $var2 = 12.0;
    $var3 = "PHP";
    $var4 = false;
    $var5 = "5a";
    ?>
    <h1>Tableau des variables</h1>
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
</html>