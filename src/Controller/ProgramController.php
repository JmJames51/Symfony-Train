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
use App\Form\SearchProgramType;
use App\Repository\ActorRepository;
use App\Repository\ProgramRepository;
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

    public function index(Request $request, ProgramRepository $programRepository): Response
    {
        $form = $this->createForm(SearchProgramType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $programs = $programRepository->findLikeName($search);
        } else {
            $programs = $programRepository->findAll();
        }

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }
    /**
     * The controller for the program add form
     *
     * @Route("/new", name="new")
     */
    public function new(Request $request, SluggerInterface $slugger, Slugify $slugify): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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

            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);

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
     * @Route("/{slug}",name="show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"slug" : "slug"}})
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
     * @Route("/{slug}/season/{season_id}", name="show_season")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"slug" : "slug"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id" : "id"}})
     */
    public function showSeason(Program $program, Season $season): Response
    {

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/season_show.html.twig', [
            'season' => $season,
            'program' => $program,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{slug}/season/{season_id}/episode/{episode_id}", name="show_episode")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"slug": "slug"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @ParamConverter("episodes", class="App\Entity\Episode", options={"mapping": {"episode_id": "id"}})
     */
    public function showEpisode(Program $program, Season $season, Episode $episodes): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('program/episode_show.html.twig', [
            'season' => $season,
            'program' => $program,
            'episodes' => $episodes,
            'categories' => $categories,
        ]);
    }
}
