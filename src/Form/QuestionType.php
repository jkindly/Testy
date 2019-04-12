<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Pytanie...',
                    'required' => true,
                ]
            ])
            ->add('answer1', null, [
                'attr' => [
                    'placeholder' => 'Odpowiedź A...'
                ]
            ])
            ->add('answer2', null, [
                'attr' => [
                    'placeholder' => 'Odpowiedź B...'
                ]
            ])
            ->add('answer3', null, [
                'attr' => [
                    'placeholder' => 'Odpowiedź C...'
                ]
            ])
            ->add('answer4', null, [
                'attr' => [
                    'placeholder' => 'Odpowiedź D...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
            'label' => false,
            'validation_groups' => ['test_questions'],
        ]);
    }
}
