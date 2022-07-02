<?php
$a = 'steak frite';
echo "un $a a été commandé"; 
echo "<br/>"; 
switch ($a){
    case 'lasagne' :
        echo " le client est satisfait de sa commande";
        break;
    case 'pizza' :
        echo "le client est satisfait de sa commande";
        break;
    case 'camembert' :
        echo "le client est satisfait de sa commande";
        break;
    case 'steak frite' :
        echo "vous avez vraiment faim";
        break;
    default :
    echo "aucune commande n'a été passé.";
}

