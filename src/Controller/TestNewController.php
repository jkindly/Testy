<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Test;
use App\Form\TestType;
use App\Repository\TestRepository;
use App\Services\TestService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestNewController extends AbstractController
{
   /**
     * @Route("/test/new", name="app_test_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testNew(Request $request)
    {
        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        return $this->render('test/test_new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ajaxAction/test/new")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ajaxActionNewTest(Request $request)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_test_new');

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        $response = [
            'status' => 'form_invalid',
            'content' => $this->render('forms/create-new-test-form.html.twig', ['form' => $form->createView()])->getContent()
        ];

        if ($form->isValid()) {
            $response = [
                'status' => 'form_valid',
                'content' => $this->render('forms/customize-new-test-form.html.twig', [
                    'form' => $form->createView()
                ])->getContent(),
            ];

            return new JsonResponse($response);
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/ajaxAction/insert/new-test")
     * @param Request $request
     * @param TestService $newTest
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ajaxAddNewQuestions(Request $request, TestService $newTest)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_test_new');

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $request->request->get('test');
            $response = 'form_valid';
            $newTest->create($data);
        } else $response = 'form_invalid';

        return new JsonResponse($response);
    }
}
