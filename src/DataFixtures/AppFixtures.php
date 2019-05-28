<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Question;
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

        $user2 = new User();
        $user2
            ->setFirstName('Adminek')
            ->setLastName('Adminek')
            ->setEmail('example@gmail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user2, 'mnkctnob'))
            ->setUsername('admin.admin');

        $test = new Test();
        $test
            ->setName('Funkcje kwadratowe')
            ->setUser($user)
            ->setDescription('
            Test składa się z 20 pytań zamkniętych, w których tylko jedna odpowiedź jest
            prawidłowa.
            Zaliczenie od 10 punktów (maks 20 pkt)
        ');

        for ($i=0; $i<20; $i++) {
            $question = new Question();
            $question
                ->setUser($user)
                ->setTest($test)
                ->setTitle('Pytanie')
                ->setAnswer1('A. Odpowiedź 1')
                ->setAnswer2('B. Odpowiedź 2')
                ->setAnswer3('C. Odpowiedź 3')
                ->setAnswer4('D. Odpowiedź 4')
            ;
            $manager->persist($question);
        }

        $manager->persist($test);

        $manager->persist($user);
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
