<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdvertisementType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

///**
// * Class AdController
// * @package App\Controller
// * @Route ("trialroute")
// */

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo, SessionInterface $session)
    {
        dump($session);
        // $repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Allows to create an ad
     *
     * @Route("/ads/new", name= "ad_create")
     *
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $ad = new Ad();

        $form =   $this -> createForm(AdvertisementType::class, $ad);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            foreach ($ad->getImages() as $image) {
                $image->setAd($ad);
                $manager->persist($image);
            }
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "The advertisement <strong>{$ad->getTitle()}</strong> is been successfully submitted !"
            );


            return $this->redirectToRoute('ad_show', [
                'slug' => $ad->getSlug()
            ]);
        }


        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Display a form o edit
     * @Route("/ads/{slug}/edit", name="ad_edit")
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager){
        $form =   $this -> createForm(AdvertisementType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            foreach ($ad->getImages() as $image) {
                $image->setAd($ad);
                $manager->persist($image);
            }
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "The advertisement <strong>{$ad->getTitle()}</strong> has been successfully edited !"
            );


            return $this->redirectToRoute('ad_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad
        ]);
    }



    /**
     * To show a single ad
     *
     * @Route("/ads/{slug}", name = "ad_show")
     *
     * @return Response
     */
    public function show(Ad $ad){
        // $ad = $repo->findOneBySlug($slug);

        return $this->render('ad/show.html.twig',[
            'ad' => $ad
        ]);

    }


    
}
