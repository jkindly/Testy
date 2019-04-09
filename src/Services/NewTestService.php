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

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function create(string $testName)
    {
        $user = $this->security->getUser();
        $test = new Test();
        $test
            /** @var User|Security $user */
            ->setUser($user)
            ->setName($testName)
        ;
        $this->em->persist($test);
        $this->em->flush();
    }
}