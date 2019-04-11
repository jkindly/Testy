<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Test;
use App\Form\TestType;
use App\Services\NewTestService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewTestController extends AbstractController
{
   /**
     * @Route("/new/test", name="app_new_test")
     */
    public function newTest(Request $request)
    {
        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            $questions = $form->getData()->getQuestions();
//            foreach ($questions as $question) {
//                /*** @var Question $question */
//                $question->setTest($test);
//                $em->persist($question);
//            }
//            $em->persist($test);
//            $em->flush();
//        }

        return $this->render('new_test/new_test.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ajaxAction/new/test")
     */
    public function ajaxActionNewTest(Request $request, NewTestService $newTest)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_new_test');

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        $response = [
            'status' => 'form_invalid',
            'content' => $this->render('forms/create-new-test-form.html.twig', ['form' => $form->createView()])->getContent()
        ];

        if ($form->isValid()) {
            $testName = $request->request->get('test')['name'];
            $newTest->create($testName);

            $response = [
                'status' => 'form_valid',
                'content' => $this->render('forms/customize-new-test-form.html.twig', [
                    'testName' => $testName,
                    'form' => $form->createView()
                ])->getContent(),
                'test' => $newTest->getCurrentTest(),
            ];

            return new JsonResponse($response);
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/ajaxAction/add/questions")
     */
    public function ajaxAddNewQuestions(Request $request)
    {
        if (!$request->isXmlHttpRequest()) return $this->redirectToRoute('app_new_test');


        $data = $request->request->get('test');

        return new JsonResponse($data);
    }
}
