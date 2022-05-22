<?php
$a = 1;
$b = 4;

echo ($a == $b) ? 'a($a) est égal à b($b)' : "a($a) est différent (&lt;not equal&gt;) de b($b)";

echo"<br/>", $c ?? $a ?? $b;
/*
un test de non nullité soit ensuite réalisée avec une troisième variable non déclarée placée en 
première position de l'opérateur de coalescence (noté ??).
*/