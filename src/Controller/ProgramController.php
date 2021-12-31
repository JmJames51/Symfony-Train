<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Season;
use App\Form\ProgramType;
use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use App\Service\Slugify;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'categories' => $categories,
        ]);
    }
    /**
     * The controller for the program add form
     *
     * @Route("/new", name="new")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $posterFile = $form->get('poster')->getData();

            if ($posterFile) {
                $originalFileName = pathinfo($posterFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '.' . $posterFile->guessExtension();

                try {
                    $posterFile->move(
                        $this->getParameter('poster_directory'),
                        $newFileName
                    );
                } catch (FileException $e) {
                }

                $program->setPoster($newFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();

            return $this->redirectToRoute('program_index');
        }

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/new.html.twig', [
            'form' => $form->createView(),
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{program_id}", name="show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id" : "id"}})
     * @return Response
     */
    public function show(Program $program, Slugify $slugify): Response
    {

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'categories' => $categories,
            'slug' => $slugify,
        ]);
    }

    /**
     * @Route("/{program_id}/season/{season_id}", name="show_season")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id" : "id"}})
     * @ParamConverter("seasons", class="App\Entity\Season", options={"mapping": {"season_id" : "id"}})
     */
    public function showSeason(Program $program, Season $seasons): Response
    {

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/season_show.html.twig', [
            'seasons' => $seasons,
            'program' => $program,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{program_id}/season/{season_id}/episode/{episode_id}", name="show_episode")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("seasons", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @ParamConverter("episodes", class="App\Entity\Episode", options={"mapping": {"episode_id": "id"}})
     */
    public function showEpisode(Program $program, Season $seasons, Episode $episodes): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/episode_show.html.twig', [
            'seasons' => $seasons,
            'program' => $program,
            'episodes' => $episodes,
            'categories' => $categories,
        ]);
    }
}
