<?php
$fname = $_GET['file'] ?? './tmp/test.txt';         // permet de transmettre par url, si il n'envoie rien, on va ouvrir tmp/test.php

if ($fp = @fopen($fname, 'r')) {                    // si le fichier est ouvert
  header('Content-Type:text/plain; charset=utf-8'); // on envoie le header
  fpassthru($fp);                                   // on envoie le fpassthru
} else {                                            // sinon on affiche un message en html
  printf("<p>Ouverture de <samp>%s</samp> impossible</p>\n", $fname);
}