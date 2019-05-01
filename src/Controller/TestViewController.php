<?php

namespace App\Controller;

use App\Entity\Test;
use App\Services\TestService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/test/pdf/{testId}", name="app_test_pdf_view")
     * @param Pdf $pdf
     * @return Response
     */
    public function pdfView(Pdf $pdf, $testId)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)
            ->findOneBy([
                'id' => $testId,
                'user' => $this->getUser()
            ])
        ;

        if (!$test) return $this->redirectToRoute('app_dashboard');

        $htmlView = $this->renderView('test/pdf_view.html.twig', [
            'test' => $test
        ]);

        return new Response(
            $pdf->getOutputFromHtml($htmlView),
            200,
            [
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$test->getName().'.pdf"'
            ]
        );
    }

    /**
     * @Route("/test/download/{testId}", name="app_test_download")
     * @param Pdf $pdf
     * @param $testId
     * @return Response
     */
    public function pdfDownload(Pdf $pdf, $testId)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)
            ->findOneBy([
                'id' => $testId,
                'user' => $this->getUser()
            ])
        ;

        if (!$test) return $this->redirectToRoute('app_dashboard');

        $htmlView = $this->renderView('test/pdf_view.html.twig', [
            'test' => $test
        ]);

        return new Response(
            $pdf->getOutputFromHtml($htmlView),
            200,
            [
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$test->getName().'.pdf"'
            ]
        );

    }

    /**
     * @Route("/test/remove/{testId}", name="app_test_remove")
     * @param $testId
     * @param TestService $testService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeTest($testId, TestService $testService)
    {
        $test = $this->getDoctrine()->getRepository(Test::class)
            ->findOneBy([
                'id' => $testId,
                'user' => $this->getUser()
            ])
        ;

        if (!$test) return $this->redirectToRoute('app_dashboard');

        $testService->removeTest($test);

        $this->addFlash('success', 'Test został pomyślnie usunięty');

        return $this->redirectToRoute('app_dashboard');
    }

}
