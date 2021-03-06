<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdvertisementType extends ApplicationType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->getConfiguration('Title', "Type a new title")
            )
            ->add(
                'slug',
                TextType::class,
                $this->getConfiguration('Channel URL', "URL address (automatic if empty)", ['required' => false])
            )
            ->add(
                'coverImage',
                UrlType::class,
                $this->getConfiguration('Image URL', "Insert an URL for the image")
            )
            ->add(
                'introduction',
                TextType::class,
                $this->getConfiguration('Introduction', "Type an intro")
            )
            ->add(
                'content',
                TextareaType::class,
                $this->getConfiguration('Detailed description', "Type a full description")
            )
            ->add(
                'rooms',
                IntegerType::class,
                $this->getConfiguration('Number of rooms', "Number of available rooms")
            )
            ->add(
                'price',
                MoneyType::class,
                $this->getConfiguration('Price for the night', "Type a price for the night")
            )
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )

//            ->add(
//                'images',
//                CollectionType::class,
//                [
//                    'entry_type' => ChoiceType::class,
//                    'entry_options'  => [
//                        'choices'  => [
//                            'Nashville' => 'nashville',
//                            'Paris'     => 'paris',
//                            'Berlin'    => 'berlin',
//                            'London'    => 'london',
//                        ],
//                    ],
//
//                ]
//            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
