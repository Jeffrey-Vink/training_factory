<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('loginName', TextType::class, [
                'label' => 'Gebruikersnaam',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Wachtwoord',
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Voornaam',
            ])
            ->add('prePosition', TextType::class, [
                'label' => 'Tussenvoegsel',
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Achternaam',
            ])
            ->add('dateOfBirth', BirthdayType::class, [
                'label' => 'Geboortedatum',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Geslacht',
                'choices' => [
                    'Man' => 'man',
                    'Vrouw' => 'vrouw',
                ]
            ])
            ->add('emailAddress', TextType::class, [
                'label' => 'E-mail',
            ])
            ->add('hiringDate', DateType::class, [
                'label' => '',
                'required' => false,
            ])
            ->add('salary', NumberType::class, [
                'label' => '',
                'required' => false,
            ])
            ->add('street', TextType::class, [
                'label' => '',
                'required' => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => '',
                'required' => false,
            ])
            ->add('place', TextType::class, [
                'label' => '',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
