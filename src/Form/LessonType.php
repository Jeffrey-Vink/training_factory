<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateTime', DateTimeType::class, [
                'label' => 'Datum en tijd'
            ])
            ->add('location', IntegerType::class, [
                'label' => 'Locatie'
            ])
            ->add('maxPersons', IntegerType::class, [
                'label' => 'Maximaal aantal mensen'
            ])
            ->add('training', ChoiceType::class, [
                'choices' => 'choices',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
