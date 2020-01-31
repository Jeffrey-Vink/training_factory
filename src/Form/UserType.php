<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Actief account'
            ])
            ->add('username', TextType::class, [
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
                'label' => 'Startdatum',
                'years' => range(date('Y'), date('Y') +1),
                'required' => false,
            ])
            ->add('salary', NumberType::class, [
                'label' => 'Salaris',
                'required' => false,
            ])
            ->add('street', TextType::class, [
                'label' => 'Straat + huisnummer',
                'required' => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Postcode',
                'required' => false,
            ])
            ->add('place', TextType::class, [
                'label' => 'Woonplaats',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
