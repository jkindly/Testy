<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class YourQuestionsController extends AbstractController
{
    /**
     * @Route("/questions", name="app_questions")
     */
    public function index()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)
            ->findBy(['user' => $this->getUser()]);

        return $this->render('your_questions/questions.html.twig', [
            'questions' => $questions,
        ]);
    }
}
