<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/inscription', name: 'inscription')]
    public function inscription(): Response
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
