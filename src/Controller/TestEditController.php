<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\QuestionType;
use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestEditController extends AbstractController
{
    /**
     * @Route("/test/edit/{testId}", name="app_test_edit")
     * @param $testId
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function testEdit($testId, Request $request)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)
            ->findOneBy([
                'id' => $testId,
                'user' => $this->getUser()
            ])
        ;

        if (!$test) return $this->redirectToRoute('app_dashboard');

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        return $this->render('test/test_edit.html.twig', [
            'test' => $test,
            'form' => $form->createView(),
        ]);
    }
}
