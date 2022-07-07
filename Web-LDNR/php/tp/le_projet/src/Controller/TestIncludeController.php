<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestIncludeController extends AbstractController
{
  
  public function index(): Response
  {
    $id = [['nom' => 'Nivelle', 'prenom' => "Emma", 'age' => 16],
           ['nom' => 'Ricow', 'prenom' => "Lea", 'age' => 31],
           ['nom' => 'Tournelle', 'prenom' => "Henri", 'age' => 88],
           ['nom' => 'Pererien', 'prenom' => "Ines", 'age' => 38],
           ['nom' => 'Fistole', 'prenom' => "Lara", 'age' => 52],
           ['nom' => 'Pudbierdanslfrigo', 'prenom' => "Roger", 'age' => 24],
           ['nom' => 'Part', 'prenom' => "Leo", 'age' => 27],
           ['nom' => 'Bolla', 'prenom' => "Tom", 'age' => 8]];
    shuffle($id);
    return $this->render('test/do_include.html.twig', ['liste_id' => $id]);
  }
  
}