<?php

namespace App\Controller;

use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function dashboard()
    {
        $lastEdited = $this->getDoctrine()->getRepository(TestRepository::class)
            ->find

        return $this->render('dashboard/dashboard.html.twig', [
            'lastEdited' => $lastEdited
        ]);
    }
}
