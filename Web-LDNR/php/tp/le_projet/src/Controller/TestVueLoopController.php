<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
 
class TestVueLoopController extends AbstractController
{
  public function index(): Response
  {
    $prenoms = ['feminin' => ["Emma", "Jade", "Léa", "Chloé", "Manon", "Inès", "Camille", "Sarah", "Zoé", "Lola"],
                'masculin' => ["Lucas", "Nathan", "Enzo", "Louis", "Mathis", "Jules", "Gabriel", "Hugo", "Raphaël", "Léo"]];
    return $this->render('test/loop.html.twig', ['prenoms' => $prenoms]);
  }
 
}