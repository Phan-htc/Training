<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Style;
use App\Form\StyleType;

class FormColorController extends AbstractController
{

  /**
   * @Route(
   *        "/test_form_color/{color}/{font}/{string}",
   *        name="test_form_color",
   *        defaults={
   *                 "color": "#00FFFF",
   *                 "font": "arial",
   *                 "string": "",
   *        },
   * )
   */
  public function index(Request $request, $color, $string, $font): Response {
    $excpt = '';
    $alert = '';
    $stl = new Style();
    $stl->setColor($color);
    $stl->setFont($font);
    $stl->setString($string);
    
    try {
      $form = $this->createForm(StyleType::class, $stl);
      $form->handleRequest($request);

      if ($form->isSubmitted()) {
        if ($form->isValid()) {
          //$alert = "valide";
          return $this->render('FormColor/index.html.twig', ['style' => $stl]);
        } else {
          $alert = 'Formulaire invalide';
        }
      }
    } catch (\Exception $e) {
      $vueform = '';
      $excpt = $e->getMessage();
    }
    return $this->renderForm('FormSimple/index.html.twig', ['errors'    => $alert,
                                                            'exception' => $excpt,
                                                            'form'      => $form]);
  }
}
