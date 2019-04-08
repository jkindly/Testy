<?php

namespace App\Controller;

use App\Form\TestType;
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
    public function ajaxActionNewTest(Request $request)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_new_test');

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        $formData = $request->request->get('test')['name'];

        $response = $this->render('forms/create-new-test-form.html.twig', [
            'form' => $form->createView()
        ])->getContent();

        return new JsonResponse($response);
    }
}
