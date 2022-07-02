<?php
header("content-type: image/PNG");

$image = @ImageCreate ( 600, 600) or 
    die("Erreur lors de la création de l'image");
/*  CONSIGNE
    un cercle rouge,
    un rectangle noir,
    le fond soit de couleur orange.
 */
    $couleur_fond = imagecolorallocate( $image, 225, 128, 0); // fond orange
    $couleur_rect = imagecolorallocate( $image, 0, 0, 0);     // fond noir
    $couleur_cercle = imagecolorallocate( $image, 255, 0, 0); // fond rouge

    imagefilledrectangle($image, 300, 300, 100, 100, $couleur_rect); 
    imagefilledellipse($image, 150, 150, 100, 100, $couleur_cercle);
    imagepng($image);