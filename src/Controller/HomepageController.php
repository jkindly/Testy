<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index()
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) return $this->redirectToRoute('app_dashboard');

        return $this->render('homepage/homepage.html.twig');
    }
}
