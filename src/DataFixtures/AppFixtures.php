<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Test;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setFirstName('Jakub')
            ->setLastName('Kozupa')
            ->setEmail('example@gmail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user, 'mnkctnob'))
            ->setUsername('jakub.kozupa');

        $test = new Test();
        $test
            ->setName('Funkcje kwadratowe')
            ->setUser($user)
            ->setDescription('
                Test składa się z 20 pytań zamkniętych, w których tylko jedna odpowiedź jest
                prawidłowa.
                Zaliczenie od 10 punktów (maks 20 pkt)
            ')
        ;

        $manager->persist($user);
        $manager->persist($test);
        $manager->flush();

//        $category = new Category();
//        $category2 = new Category();
//        $category->setName('Fizyka');
//        $category2->setName('Matematyka');
//        $manager->persist($category);
//        $manager->persist($category2);
//        $manager->persist($user);
//        $manager->flush();
    }
}
