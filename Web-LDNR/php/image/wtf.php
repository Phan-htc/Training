<?php
// tableau contenant les valeurs
$valeurs = array(1500, 2450, 800, 1780, 1900, 2450, 1684, 1845, 3450, 980, 1234, 500);  
$max_valeur = max($valeurs);  
 
header ("Content-type: image/jpeg");  
 
$im = @imagecreatefromjpeg('photo.jpg');

$largeur = imagesx($im);
$hauteur = imagesy($im);
$step = $largeur/count($valeurs);
$width=$step/2;

$blanc      = ImageColorAllocate ($im, 255, 255, 255);  
$noir       = ImageColorAllocate ($im, 0, 0, 0);  
$bleu_fonce = ImageColorAllocate ($im, 75, 130, 195);  
$bleu_clair = ImageColorAllocate ($im, 95, 160, 240);  
 
ImageLine ($im, 0, $hauteur-40, $largeur-40, $hauteur-40, $noir);  
 
// on affiche le numéro des valeurs correspondantes en partant de un
for ($i=0; $i < count($valeurs); $i++) { 
  ImageString ($im, 4, ($i)*$step, $hauteur-38, $i, $noir); 
}  

// on dessine un trait vertical axe Y
ImageLine ($im, 0, 30, 0, $hauteur-40, $noir);  
 
// on parcourt l'axe des X
for ($i=0; $i < count($valeurs); $i++) { 
    // on calcule la hauteur du baton
  $hauteurImageRectangle = ceil(((($valeurs[$i])*($hauteur-50))/$max_valeur)); 
  ImageFilledRectangle($im, ($i)*$step,   $hauteur-$hauteurImageRectangle,   ($i)*$step+$width,   $hauteur-$width,   $noir); 
  ImageFilledRectangle($im, ($i)*$step+2, $hauteur-$hauteurImageRectangle+2, ($i)*$step+$width-2, $hauteur-$width-3, $bleu_fonce); 
  ImageFilledRectangle($im, ($i)*$step+6, $hauteur-$hauteurImageRectangle+2, ($i)*$step+$width-4, $hauteur-$width-5, $bleu_clair); 
}

// on dessine le tout
Imagejpeg($im);