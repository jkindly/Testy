<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 4/9/19
 * Time: 2:30 PM
 */

namespace App\Services;

use App\Entity\Question;
use App\Entity\Test;
use App\Entity\User;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Security;

class TestService
{
    private $em;
    private $security;
    private $categoriesRepo;

    public function __construct(EntityManagerInterface $em, Security $security, CategoriesRepository $categoriesRepo)
    {
        $this->em = $em;
        $this->security = $security;
        $this->categoriesRepo = $categoriesRepo;
    }

    public function create($data)
    {
        $testName = $data['name'];
        $description = $data['description'];
        $category = $this->categoriesRepo->find($data['category']);


        $user = $this->security->getUser();
        $test = new Test();
        $test
            /** @var User|Security $user */
            ->setUser($user)
            ->setName($testName)
            ->setDescription($description)
            ->setCategory($category);

        if (!empty($data['questions'])) {
            foreach ($data['questions'] as $question) {
                if (trim($question['title']) != '') {
                    $newQuestion = new Question();
                    $newQuestion
                        ->setTitle($question['title'])
                        ->setAnswer1($question['answer1'])
                        ->setAnswer2($question['answer2'])
                        ->setAnswer3($question['answer3'])
                        ->setAnswer4($question['answer4'])
                        ->setTest($test)
                        ->setUser($user);
                    $this->em->persist($newQuestion);
                }
            }
        }

        $this->em->persist($test);
        $this->em->flush();
    }

    /**
     * @param Form $form
     * @param Test $test
     */
    public function update($test, $form)
    {
        $formData = $form->getData();
        $user = $this->security->getUser();

        $test
            ->setName($formData->getName())
            ->setDescription($formData->getDescription());

        if (!empty($formData->getQuestions())) {
            foreach ($formData->getQuestions() as $question) {
                if (trim($question->getTitle() != '')) {
                    /*** @var Question $question */
                    $question
                        ->setTitle($question->getTitle())
                        ->setAnswer1($question->getAnswer1())
                        ->setAnswer2($question->getAnswer2())
                        ->setAnswer3($question->getAnswer3())
                        ->setAnswer4($question->getAnswer4())
                        ->setTest($test)
                        /** @var User|Security $user */
                        ->setUser($user);
                    if ($question->getId() == null) $this->em->persist($question);
                }
            }
        }
        $this->em->flush();
    }

    /**
     * @param Test $test
     */
    public function removeTest($test)
    {
        $test->setUser(null);
        $this->em->flush();
    }
}