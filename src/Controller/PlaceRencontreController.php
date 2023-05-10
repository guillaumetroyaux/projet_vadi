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
        // Récupération du profil de l'utilisateur actuel
        $user = $this->getUser();
        $userRepository = $entityManager->getRepository(User::class);
        $currentUser = $userRepository->find($user->id);

        // Récupération du profil liké
        $profilRepository = $entityManager->getRepository(Profil::class);
        $likedProfil = $profilRepository->find($profilId);

        // Vérification si l'utilisateur a déjà liké ce profil
        $alreadyLiked = false;
        foreach ($currentUser->getLikes() as $like) {
            if ($like->getProfil()->getId() == $likedProfil->getId()) {
                $alreadyLiked = true;
                break;
            }
        }

        // Si l'utilisateur n'a pas encore liké ce profil, on crée une correspondance (match)
        if (!$alreadyLiked) {
            $match = new Matches();
            $match->setProfil1($currentUser->getProfil());
            $match->setProfil2($likedProfil);
            $entityManager->persist($match);
            $entityManager->flush();

            // On ajoute la correspondance à l'utilisateur actuel
            $currentUser->addMatch($match);
            $entityManager->persist($currentUser);
            $entityManager->flush();
        }

        // Redirection vers la page de rencontre
        return $this->redirectToRoute('rencontre');
    }
}
