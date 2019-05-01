<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\TestType;
use App\Services\TestService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestEditController extends AbstractController
{
    /**
     * @Route("/test/edit/{testId}", name="app_test_edit")
     * @param $testId
     * @param Request $request
     * @param TestService $testService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function testEdit($testId, Request $request, TestService $testService, Pdf $pdf)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)
            ->findOneBy([
                'id' => $testId,
                'user' => $this->getUser()
            ])
        ;

        if (!$test) return $this->redirectToRoute('app_dashboard');

        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            dd($form->getData()->getQuestions());

            $testService->update($test, $form);

            return $this->redirectToRoute('app_test_view', [
                'testId' => $testId
            ]);
        }

        return $this->render('test/test_edit.html.twig', [
            'test' => $test,
            'form' => $form->createView(),
        ]);
    }
}
