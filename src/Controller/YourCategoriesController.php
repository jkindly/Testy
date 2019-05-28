<?php

namespace App\Controller;

use App\Entity\Category;
use App\Services\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class YourCategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="app_categories")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->findBy(['user' => $this->getUser()]);

        return $this->render('your_categories/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="app_category")
     */
    public function category($id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)
            ->find($id);

        return $this->render('your_categories/category.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/ajaxAction/new-category")
     * @param Request $request
     * @param CategoryService $categoryService
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addNewCategory(Request $request, CategoryService $categoryService)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_dashboard');

        $categoryName = $request->request->get('categoryName');

        $categoryService->addNewCategory($categoryName);

        return new JsonResponse($categoryService->getCategoryStatus());
    }
}
