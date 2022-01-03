<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/actor", name="actor_")
 */
class ActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{actor_id}", name="show")
     * @ParamConverter("actor", class="App\Entity\Actor", options={"mapping": {"actor_id" : "id"}})
     * @return Response
     */
    public function show(Actor $actor): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'categories' => $categories,
        ]);
    }
}
