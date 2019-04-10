<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Test;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('name', TextType::class, [
//                'label' => false,
//                'attr' => [
//                    'class' => 'input-test',
//                ],
//            ])
//        ;
        $builder
            ->add('questions', CollectionType::class, [
                'entry_type' => QuestionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
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
