<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Test;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TestType extends AbstractType
{
    private $categoriesRepo;
    private $tokenStorage;

    public function __construct(CategoriesRepository $categoriesRepo, TokenStorageInterface $tokenStorage)
    {
        $this->categoriesRepo = $categoriesRepo;
        $this->tokenStorage = $tokenStorage;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input-test',
                    'placeholder' => 'Wprowadź nazwę'
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input-test input-test-description',
                    'placeholder' => 'Wprowadź opis testu, dodatkowe informacje',
                ],
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'placeholder' => 'Kategoria testu',
                'class' => Category::class,
                'label' => false,
                'choice_label' => function(Category $category) {
                    return $category->getName();
                },
                'attr' => [
                    'class' => 'input-test category-select',
                ],
                'choices' => $this->categoriesRepo
                    ->getUserCategories($this->tokenStorage->getToken()->getUser()->getId()),
                'mapped' => false,
                'required' => false,
            ])

        ;
        $builder
            ->add('questions', CollectionType::class, [
                'entry_type' => QuestionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false,
                'validation_groups' => 'test_questions',
            ])
        ;
//            ->add('category', EntityType::class, [
//                'class' => Category::class,
//                'label' => false,
//                'choice_label' => function(Category $category) {
//                    return $category->getName();
//                },
//                'attr' => [
//                    'class' => 'input-test'
//                ],
////                'choices' => $this->bankAccountRepository
////                    ->getUserAccounts($this->tokenStorage->getToken()->getUser()->getId()),
////                'mapped' => false
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
            'validation_groups' => ['test_name'],
            'translation_domain' => 'form',
        ]);
    }
}
