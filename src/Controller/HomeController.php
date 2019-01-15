<?php

namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * @Route("/hello/{firstName}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{firstName}", name="hello_firstName")
     * @return void
     */
    public function hello($firstName = "anonymous", $age=0) {

        return $this->render(
            'greetings.html.twig',
            [
                'firstName'=>$firstName,
                'age'=>$age
            ]
            );
    }

    /**
     * @Route("/", name = "homepage")
     *
     * @return void
     */
    public function home(){
        $firstNames = ["Lior" => 31, "Fred" =>12, "John"=>55];
       
        return $this->render('home.html.twig', [
            'title' => "Hello Everyone",
            'age' => 15,
            'firstNames'=>$firstNames
        ]);
    }

}




?>