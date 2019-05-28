<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class YourTestsController extends AbstractController
{
    /**
     * @Route("/your-tests", name="app_your_tests")
     */
    public function index()
    {
        $tests = $this->getDoctrine()->getRepository(Test::class)
            ->findBy(['user' => $this->getUser()]);


        return $this->render('your_tests/your_tests.html.twig', [
            'tests' => $tests,
        ]);
    }
}
