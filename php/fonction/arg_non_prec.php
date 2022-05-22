<?php
/*contienne la déclaration d'une fonction permettant le calcul de la somme ou du produit de ces arguments :
le premier argument is_prod sera un booléen indiquant s'il faut faire la somme (si false) 
ou le produit (si true),
le résultat sera retourné par la fonction.
Appeler cette fonction en lui donnant un mode (premier argument) et une liste de valeurs numériques.*/

declare(strict_types=1);

function sum_prod(bool $is_prod, int ...$vals): int {
    $res = $is_prod ? 1 : 0; // est ce que $is_prod est true ou false ?
    foreach($vals as $arg) {
      if ($is_prod) {
	$res *= $arg;
      } else {
	$res += $arg;
      }      
    }
    return $res;
  }
 
$r = sum_prod(false,2,3,4);
echo "le résultat est $r.\n";