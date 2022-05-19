<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="unsafe-url"/>

    <style>
        form {background-color:#CFC;}
        fieldset {width:20em;text-align:right}
    </style>

    <title>send_treat</title>
</head>
<body>

    <?php if(!isset($_GET['nom'])){ // si le champs nom est vide (!)
    ?>
    <!-- on affiche le formulaire -->
     <form action="send_treat.php" method="get">
        <fieldset>nom<input type="text" name="nom"></fieldset><br/>
        <fieldset>prenom<input type="text" name="prenom"></fieldset><br/>
        <fieldset>age<input type="text" name="age"></fieldset><br/>
        <input type="submit">
    </form>
    
    <?php } else {?>
        
    <table>
        <tr>
            <th>Variable</th>
            <th>valeur</th>
            <th>type</th>
        </tr>
        <tr>
            <td>nom</td>
            <td><?= htmlspecialchars($_GET['nom']);?></td>
            <td><?= gettype($_GET['nom']) ;?></td>
        </tr>
            <td>prenom</td>
            <td><?= htmlspecialchars($_GET['prenom']);?></td>
            <td><?=gettype($_GET['prenom']) ;?></td>
        </tr>
            <td>type</td>
            <td><?= $_GET['age'];?></td>
            <td><?= gettype($_GET['age']) ;?></td>
        </tr>
    
    </table>

    <?php } ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
</body>
</html>