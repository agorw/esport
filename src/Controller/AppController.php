<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     *
     * @Route("/", name="index")
     * @Route("/index.php", name="indexphp")
     * @Route("/index.html", name="indexhtml")
     */
    public function index()
    {
        return $this->render("app\index.html.twig");
    }

    /**
     * @Route("/home", name="home")
     */

    public function home()
    {
        return $this->render('app\home.html.twig');
    }
}
