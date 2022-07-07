<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestLayoutController extends AbstractController
{
  public function index(): Response
  {
    $prenoms = ["Emma", "Jade", "Léa", "Chloé", "Manon",
                "Inès", "Camille", "Sarah", "Zoé", "Lola"
                ];
    return $this->render('baseTest.html.twig', ['prenoms' => $prenoms]);
  }

}