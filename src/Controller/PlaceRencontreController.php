<?php

namespace App\Controller;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Profil;
use App\Entity\User;
use App\Entity\Matches;
use App\Entity\PhotoProfil;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Like;

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
        $currentUser = $userRepository->find($user->getId());
        $curentProfil = $currentUser->getProfil();

        // Récupération du profil liké
        $profilRepository = $entityManager->getRepository(Profil::class);
        $likedProfil = $profilRepository->find($profilId);
        $likedUser = $likedProfil->getUser();

        // Vérification si l'utilisateur a déjà liké ce profil
        $alreadyLiked = false;
        foreach ($currentUser->getLikes() as $like) {
            if ($like->getProfil()->getId() == $likedProfil->getId()) {
                $alreadyLiked = true;
                break;
            }
        }

        // Si l'utilisateur n'a pas encore liké ce profil, on crée un like
        if (!$alreadyLiked) {
            $like = new Like();
            $like->setProfil($likedProfil);
            $like->setUser($currentUser);
            $entityManager->persist($like);
            $entityManager->flush();

            $userLiked = false;
            foreach ($likedUser->getLikes() as $like) {
                if ($like->getProfil()->getId() == $curentProfil->getId()) {
                    $userLiked = true;
                    break;
                }
            }

            if ($userLiked) {
                $conversation = new Conversation();
                $conversation->setDebutConversation(new \DateTime());
                $conversation->setFinConversation(new \DateTime());
                $entityManager->persist($conversation);
                $entityManager->flush();
                $match = new Matches();
                $match->setProfil1($curentProfil);
                $match->setProfil2($likedProfil);
                $match->setIdConversation($conversation->getId());
                $entityManager->persist($match);
            }

            $entityManager->flush();
        }


        // Redirection vers la page de rencontre
        return $this->redirectToRoute('rencontre');
    }
}
