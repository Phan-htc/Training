<?php 
namespace App\Controller;

use App\Entity\StoreFile;
use App\Form\StoreFileType;
use App\Entity\Pays;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UploadController extends AbstractController
{
  /**
   * @Route("/store/file", name="store_file")
   */
  public function storeFile(ManagerRegistry $doctrine, Request $request): Response
  {
    $doc_db = $doctrine->getManager();
    $sf = new StoreFile();
    $form = $this->createForm(StoreFileType::class, $sf);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
      /** @var UploadedFile $ storeFileData */
      $storeFileDataCSV = $form->get('pathCSV')->getData();
      $storeFileDataZIP = $form->get('pathZIP')->getData();

      // this condition is needed because the 'path' field is not required
      // so the PDF file must be processed only when a file is uploaded
      if ($storeFileDataCSV && $storeFileDataZIP) {
        // Move the file to the directory where files are stored
        try {
          $storeFileDataCSV->move($this->getParameter('upload_directory'),'pays.csv');
          $storeFileDataZIP->move($this->getParameter('upload_directory'),'flags.zip');
          // Unzip
          $zip = new \ZipArchive;
          if ($zip->open($this->getParameter('upload_directory').'/flags.zip') === TRUE) {
            $zip->extractTo($this->getParameter('flag_directory'));
            $zip->close();
          }
          $rfile = $this->getParameter('upload_directory').'/pays.csv';
          $handle = fopen($rfile, "r");
          $reg_get = $doctrine->getRepository(Pays::class);
          if ($reg_get->findAll()) throw new \Exception("Les tables sont déjà remplies !");
          
          //On lit le fichier csv en séparant les éléments avec les [,] comme séparateur
          while ((($pl = fgetcsv($handle, 1000, ",")) !== FALSE)
          /*&& (($img = fgetzip($handle2, 1000)) !== FALSE)*/) { //tant qu'il y a des éléments, on continue de créer des lignes
              $p = new Pays();
              $p->setNom($pl[1]);
              $p->setCode($pl[2]);
              $p->setFlag($pl[2].'.'.'svg'); //'flags/flags/'.
              /*if (file_exists($pl)) {                   // si le fichier existe
                $img = file_get_contents($pl);        // on insère dans la colonne image le fichier
            } else {                                    // sinon
                $img = '';}*/
              $doc_db->persist($p);
            }
            $doc_db->flush();
        
        } catch (FileException $e) {
          // ... handle exception if something happens during file upload
        }
        
        // updates the 'storeFileData name' property to store the PDF file name
        // instead of its contents
        //$sf->setPath($newFilename);
        //$doc_db->persist($sf);
        //unset($v);
        //$doc_db->flush();
      }
      
      // ... persist the $product variable or any other work
      
      return $this->redirectToRoute('list_pays');
    }
    
    return $this->renderForm('FormUpload/formUpload.html.twig', [
      'form' => $form,
    ]);
  }

  /**
   * @Route("/list/files/{lastInsert}", name="list_pays", defaults={"lastInsert": ""})
   */
  public function listFiles(ManagerRegistry $doctrine, string $lastInsert): Response
  {
    $tbl = $doctrine->getRepository(Pays::class);
     
    return $this->render('showArray.html.twig', [
      'results' => $tbl->findAll(),
      'errors' => null,
    ]);
  }
}