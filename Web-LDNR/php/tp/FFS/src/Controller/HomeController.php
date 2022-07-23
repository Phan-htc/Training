<?php
namespace App\Controller;

use App\Entity\Pays;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function listFiles(ManagerRegistry $doctrine): Response
    {
      $tbl = $doctrine->getRepository(Pays::class);
       
      return $this->render('home/index.html.twig', [
        'results' => $tbl->findAll(),
        'errors' => null,
      ]);
    }
}
