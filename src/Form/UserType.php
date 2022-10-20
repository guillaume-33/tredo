<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class,[
                'attr'=>['placeholder'=>'Entrez votre nom']
                ])
            ->add('password', RepeatedType::class,[
                'first_options'=>['label'=>'Mot de passe'],
                'second_options'=>['label'=>'Confirmez le mot de passe'],
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe ne correspond pas',
                'constraints'=>[new Length(['min'=>8])],
                'invalid_message'=>'le mot de passe doit contenir au moins 8 caractères'
            ])
            ->add('nom' , TextType::class,[
                'attr'=>['placeholder'=>'Entrez votre nom']
            ])
            ->add('prenom', TextType::class,[
                'attr'=>['placeholder'=>'Entrez votre prénom']
            ])
//            ->add('telephone', TextType::class,[
//                'attr'=>['placeholder'=>'Entrez votre numéro de téléphone']
//            ])

            ->add('confirmer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
