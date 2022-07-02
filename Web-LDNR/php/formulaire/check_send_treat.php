<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>Résultat du passage des variables du formulaire de test.</title>
    <style type="text/css">
     table,td,th {border:1px solid #000;}
     .error {color:#F00;}
    </style>
  </head>
  <body>
    <?php
    if (!isset($_GET['envoyer']) || $_GET['nom'] == '' || $_GET['prenom'] =='' || !is_numeric($_GET['age'])) {
    ?>
      <form action="#" method="get">
	<fieldset>Nom <input type="text" name="nom" />
	  <?= isset($_GET['envoyer']) && $_GET['nom'] == '' ? '<em class="error">il faut indiquer le nom</em>' : '' ?>
	</fieldset>
	<fieldset>Prénom <input type="text" name="prenom" />
	  <?= isset($_GET['envoyer']) && $_GET['prenom'] == '' ? '<em class="error">il faut indiquer le prenom</em>' : '' ?>
	</fieldset>
	<fieldset>Âge <input type="text" name="age" />
	  <?php if (isset($_GET['envoyer']) && !is_numeric($_GET['age'])) echo '<em class="error">il faut indiquer l\'age en tant que valeur numérique</em>'; ?>
	</fieldset>
	<input type="submit" value="Envoyer" name="envoyer">
      </form>
    <?php
    } else {
    ?>
      <table>
	<tr>
	  <th>Variable</th>
	  <th>Valeur</th>
	  <th>Type</th>
	</tr>
	<tr>
	  <td>nom</td>
	  <td><?= htmlspecialchars($_GET['nom'])?></td>
	  <td><?= gettype($_GET['nom'])?></td>
	</tr>
	<tr>
	  <td>prenom</td>
	  <td><?= htmlspecialchars($_GET['prenom'])?></td>
	  <td><?= gettype($_GET['prenom'])?></td>
	</tr>
	<tr>
	  <td>nom</td>
	  <td><?= htmlspecialchars($_GET['age'])?></td>
	  <td><?= gettype($_GET['age'])?></td>
	</tr>
      </table>
 
    <?php
    }
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>