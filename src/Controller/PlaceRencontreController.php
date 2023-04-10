<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Profil;


class PlaceRencontreController extends AbstractController
{
    #[Route('/place-rencontre', name: 'rencontre')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository =  $entityManager->getRepository(Profil::class);
        $profils = $repository->findAll();
        return $this->render('application/rencontre.html.twig', [
            'profils' => $profils,
        ]);
    }
}
