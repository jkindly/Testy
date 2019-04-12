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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class NewTestService
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function create($data)
    {
        $testName = $data['name'];
        $description = $data['description'];

        $user = $this->security->getUser();
        $test = new Test();
        $test
            /** @var User|Security $user */
            ->setUser($user)
            ->setName($testName)
            ->setDescription($description)
        ;

        if (!empty($data['questions'])) {
            foreach ($data['questions'] as $question) {
                if (!trim($question['title']) == '') {
                    $newQuestion = new Question();
                    $newQuestion
                        ->setTitle($question['title'])
                        ->setAnswer1($question['answer1'])
                        ->setAnswer2($question['answer2'])
                        ->setAnswer3($question['answer3'])
                        ->setAnswer4($question['answer4'])
                        ->setTest($test)
                    ;
                    $this->em->persist($newQuestion);
                }
            }
        }

        $this->em->persist($test);
        $this->em->flush();
    }
}