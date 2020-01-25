<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\EndUser;
use Faker\Factory;
//use Cocur\Slugify\Slugify;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('en_EN');
//        $slugify = new Slugify();


        //Users management
        $users = []; //array to be used for the ads generation
        $genders = ['male', 'female'];

        for ($i = 1; $i<=10; $i++ ) {
            $user = new EndUser();

            $gender = $faker->randomElement($genders);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1,99).'jpg';

            $picture .=($gender == 'male' ? 'men/' : 'women/').$pictureId;

            $hash = $this->encoder->encodePassword($user, 'password');


            $user->setFirstName($faker->firstName($gender))
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setIntroduction($faker->sentence())
                ->setDescription('<p>'.join('</p>.<p>', $faker->paragraphs(3)).'</p>')
                ->setPicture($picture)
                ->setHash($hash);
            $manager->persist($user);
            $users[]=$user;
        }

        //Ad management
        for ($i = 1; $i <= 30; $i++) {
            $ad = new Ad();

            $title = $faker->sentence();
//            $slug = $slugify->slugify($title);
            $coverImage = $faker ->imageUrl(1000, 350);
            $introduction = $faker -> paragraph(2);
            //paragraphs give an array of paragraphs
            $content = '<p>'.join('</p>.<p>', $faker->paragraphs(5)).'</p>';

            $user = $users[mt_rand(0, count($users)-1)];



            $ad->setTitle($title)
//                ->setSlug($slug)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 53))
                ->setAuthor($user);

            
            for ($j=1; $j <= mt_rand(2, 5); $j++) {
                $image = new Image();

                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setAd($ad);
                $manager->persist($image);
            }
            $manager->persist($ad);
        }
        $manager->flush();
    }
}
