<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestViewController extends AbstractController
{
    /**
     * @Route("/test/view/{testId}", name="app_test_view")
     * @param $testId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function testView($testId)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)
            ->findOneBy([
                'id' => $testId,
                'user' => $this->getUser()
            ])
        ;

        if (!$test) return $this->redirectToRoute('app_dashboard');

        return $this->render('test/test_view.html.twig', [
            'test' => $test,
        ]);
    }
}
