<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 5/28/19
 * Time: 4:14 PM
 */

namespace App\Services;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CategoryService
{
    private $em;
    private $user;
    private $categoryStatus = 'failed';

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->user = $security->getUser();
    }

    public function addNewCategory(string $categoryName)
    {
        if ($categoryName != '') {
            $category = new Category();
            $category
                ->setName($categoryName)
                ->setUser($this->user)
            ;

            $this->em->persist($category);
            $this->em->flush();

            $this->categoryStatus = 'success';
        }
    }

    public function getCategoryStatus()
    {
        return $this->categoryStatus;
    }

}