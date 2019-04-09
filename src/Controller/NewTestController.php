<?php

namespace App\Controller;

use App\Form\TestType;
use App\Services\NewTestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewTestController extends AbstractController
{
   /**
     * @Route("/new/test", name="app_new_test")
     */
    public function newTest(Request $request)
    {
        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) return $this->redirectToRoute('app_new_test');


        return $this->render('new_test/new_test.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ajaxAction/new/test")
     */
    public function ajaxActionNewTest(Request $request, NewTestService $newTest)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_new_test');

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        $testName = $request->request->get('test')['name'];

        $response = [
            'status' => 'form_invalid',
            'content' => $this->render('forms/create-new-test-form.html.twig', ['form' => $form->createView()])->getContent()
        ];

        if ($form->isValid()) {
            $newTest->create($testName);

            $response = [
                'status' => 'form_valid',
                'content' => $this->render('forms/customize-new-test-form.html.twig', ['testName' => $testName])->getContent()
            ];

            return new JsonResponse($response);
        }

        return new JsonResponse($response);
    }
}
