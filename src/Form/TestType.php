<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Test;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => false,
                'attr' => [
                    'class' => 'input-test',
                    'placeholder' => 'Wprowadź nazwę'
                ]
            ])
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
        ]);
    }
}
