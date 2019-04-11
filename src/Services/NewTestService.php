<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 4/9/19
 * Time: 2:30 PM
 */

namespace App\Services;


use App\Entity\Test;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class NewTestService
{
    private $em;
    private $security;
    private $test;

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
        $this->test = new Test();
        $this->test
            /** @var User|Security $user */
            ->setUser($user)
            ->setName($testName)
            ->setDescription($description)
        ;
        $this->em->persist($this->test);
        $this->em->flush();
    }

    public function getCurrentTest()
    {
        return $this->test;
    }
}