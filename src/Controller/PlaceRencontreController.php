<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceRencontreController extends AbstractController
{
    #[Route('/place-rencontre', name: 'rencontre')]
    public function home(): Response
    {
        return $this->render('application/rencontre.html.twig');
    }
}
