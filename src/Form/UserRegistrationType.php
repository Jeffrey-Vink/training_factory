<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationType extends AbstractType
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
            ->add('roles', HiddenType::class, [
                'data' => '[\'ROLE_USER\']',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'register',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}