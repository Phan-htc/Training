/*==============================================================================================================================*/
//                                               RECURSIVITE
/*==============================================================================================================================*/

/*
une fonction recursive est une fonction qui s'appelle elle meme de manières divers.

*/
function Puissance(nombre, puissance){
    if (puissance == 1) {
        return nombre;
    } else { return nombre * Puissance (nombre, puissance-1);
    }
}
nombre = 2;
puissance = 256;
resultat = Puissance($nombre, $puissance);
console.log("le résultat de $nombre à la puissance $puissance est $resultat.")