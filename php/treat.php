<?php
//afficher résultats  champs transmis 
//formulaire + leur type  
//forme de tableau HTML.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>treat</title>
</head>
<body>
<h1>Treat</h1>
<table>
    <tr>
        <th>Variable</th>
        <th>valeur</th>
        <th>type</th>
    </tr>
    <tr>
        <td>nom</td>
        <td><?php echo htmlspecialchars($_GET['nom']);?></td>
        <td><?php echo gettype($_GET['nom']) ;?></td>
    </tr>
        <td>prenom</td>
        <td><?php echo htmlspecialchars($_GET['prenom']);?></td>
        <td><?php echo gettype($_GET['prenom']) ;?></td>
    </tr>
        <td>type</td>
        <td><?php echo $_GET['age'];?></td>
        <td><?php echo gettype($_GET['age']) ;?></td>
    </tr>
    
</table>
</body>
</html>
