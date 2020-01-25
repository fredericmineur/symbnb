<?php

namespace App\Form;

use App\Entity\EndUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration('First Name', 'First Name'))
            ->add('lastName', TextType::class, $this->getConfiguration('Last name', 'Last name'))
            ->add('email', EmailType::class, $this->getConfiguration('Email', 'Email'))
            ->add('picture', UrlType::class, $this->getConfiguration('Profile picture', 'Pic URL'))
            ->add('hash', PasswordType::class, $this->getConfiguration('Password', 'Password'))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration('password confirmation', 'please confirm your password'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction', 'Present yourself'))
            ->add('description', TextareaType::class, $this->getConfiguration('Detailed description', 'Describe yourself'))

        ;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EndUser::class,
        ]);
    }
}
