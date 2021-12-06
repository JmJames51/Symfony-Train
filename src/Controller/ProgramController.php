<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
     /**
      * Correspond à la route /program/ et au name "program_index"
      * @Route("/program/", name="program_index")
      */
     public function index(): Response
     {
         // ...
     }

     /**
      * Correspond à la route /program/new et au name "program_new"
      * @Route("/program/new/", name="program_new")
      */
     public function new(): Response
     {
         // ...
     }
     /**
     * @Route("/Program/{id}", methods={"GET"},requirements={"id"="\d+"}, name="program_show")
     */
    public function show(int $id): Response
    { 
        return $this->render('/Program/show.html.twig', ['id' => $id ]);
    }
}