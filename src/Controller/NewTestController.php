<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewTestController extends AbstractController
{
    /**
     * @Route("/new", name="app_new_test")
     */
    public function newTest()
    {
        return $this->render('new_test/index.html.twig', [
            'controller_name' => 'NewTestController',
        ]);
    }
}
