<?php

function Puissance($nombre, $puissance){
    if ($puissance == 1) {
        return $nombre;
    } else { return $nombre * puissance ($nombre, $puissance-1);
    }
}
$nombre = 2;
$puissance = 256;
$resultat = Puissance($nombre, $puissance);
echo "le résultat de $nombre à la puissance $puissance est $resultat.\n";