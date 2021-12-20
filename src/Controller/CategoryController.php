<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Entity\Program;
use App\Entity\Category;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['category' => $category]
        );
    }

    /**
     * @Route("/{categoryName}", name="show")
     * * @return Response A response instance
     */
    public function show(string $categoryName, ProgramRepository $programRepository, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $programs = $programRepository->findByCategory($category, ['id' => 'desc'], '3');

        return $this->render('category/show.html.twig', ['category' => $category, 'programs' => $programs, 'categories' => $categories]);
    }
}
