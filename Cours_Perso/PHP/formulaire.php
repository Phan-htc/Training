<?php
/*====================================================================== */
// PARTIE LOGIQUE
/*====================================================================== */
// Declaration des variables
$aDeviner = 150;
$erreur = null;
$succes = null;
$value = null;

if (isset($_GET['chiffre'])) {                      // si on récupère la valeur $_GET correspondant a la valeur de chiffre 
    if ($_GET['chiffre'] < $aDeviner) {             // si $_GET est supérieur a $aDeviner
        $erreur = "votre chiffre est trop grand";   // on affiche $erreur avec le message trop grand 
    } elseif ($_GET['chiffre'] > $aDeviner) {       // sinon si $_GET est inférieur a $aDeviner
        $erreur = "votre chiffre est trop petit";   // on affiche $erreur avec le message trop petit
    }
} else {                                            // sinon on affiche le message de $succes 
    $succes = "Bravo ! vous avez deviné le chiffre <strong>$aDeviner</strong>";
}
$value = (int)$_GET['chiffre'];                     // On spécifie que $_GET est un entier
?>                                                  

<?php if ($erreur): ?>    
<div class="alert-danger">
    <?= $erreur ?>
</div>

<?php elseif ($succes): ?>
<div class="alert-succes">
    <?= $succes ?>
</div>
    
<?php endif ?>

<!--====================================================================== 
 PARTIE FORMULAIRE
====================================================================== -->
<form action="#" method="GET">
    <div>
        <input type="number" name="chiffre" placeholder="entre 0 et 1000" value="<?php htmlentities($_GET['chiffre'])?>">
    </div>
    <button type="submit">Devine</button>
</form>