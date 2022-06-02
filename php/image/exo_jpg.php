<?php
header("content-type: image/jpeg"); //produire une image JPG 
$image('photo.jpg');
/*

Elle présente un histogramme à partir d'un tableau de valeurs,
la photo ici présente soit utilisée en image de fond,
la dimension de l'histogramme s'ajuste à celle de la photo. */
$tab = array(10, 17, 12, 17, 19, 15, 22);
foreach ($tab as $value){
    $couleur_rect = imagecolorallocate( $image, 43, 33, 120);
    imagefilledrectangle($image, 330, 440, 210 , 330, $couleur_rect);
}
imagecreatefromjpeg($photo);

imagejpeg($image);