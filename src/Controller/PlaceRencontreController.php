<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Profil;
use App\Entity\User;
use App\Entity\Matches;
use App\Entity\PhotoProfil;
use App\Form\LikeType;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Request;




class PlaceRencontreController extends AbstractController
{
    #[Route('/place-rencontre', name: 'rencontre')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $repository =  $entityManager->getRepository(Profil::class);
        $profils = $repository->findAll();
        $repository =  $entityManager->getRepository(PhotoProfil::class);
        $photoProfil = $repository->findAll();
        return $this->render('application/rencontre.html.twig', [
            'profils' => $profils, 'photoProfil' => $photoProfil,
        ]);
    }

    #[Route('/place-rencontre/{profilId}', name: 'match')]
    public function match(EntityManagerInterface $entityManager, Request $request, $profilId): Response
    {
        $repository =  $entityManager->getRepository(Profil::class);
        $profils = $repository->findAll();
        $repository =  $entityManager->getRepository(PhotoProfil::class);
        $photoProfil = $repository->findAll();



        return $this->render('application/rencontre.html.twig', [
            'profils' => $profils, 'photoProfil' => $photoProfil,
        ]);
    }
}
