<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function dashboard()
    {
        $lastEdited = $this->getDoctrine()->getRepository(Test::class)
            ->findLast3Tests($this->getUser());

        return $this->render('dashboard/dashboard.html.twig', [
            'lastEdited' => $lastEdited
        ]);
    }
}
