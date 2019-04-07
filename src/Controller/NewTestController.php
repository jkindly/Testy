<?php

namespace App\Controller;

use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewTestController extends AbstractController
{
    /**
     * @Route("/new", name="app_new_test")
     */
    public function newTest(Request $request)
    {
        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);


        return $this->render('new_test/new_test.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
