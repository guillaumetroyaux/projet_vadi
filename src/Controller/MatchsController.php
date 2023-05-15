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





class MatchsController extends AbstractController
{
    #[Route('/mes-matchs', name: 'matchs')]
    public function listeMatch(EntityManagerInterface $entityManager, Request $request): Response
    {
        $idProfil = $entityManager->getRepository(Profil::class)->findOneBy(['user' => $this->getUser()]);
        $Matchrepository =  $entityManager->getRepository(Matches::class);
        $matchs = $Matchrepository->findBy(['profil1' => $idProfil]) + $Matchrepository->findBy(['profil2' => $idProfil]);
        $matchedProfils = [];
        if ($matchs === null) {
            $matchedProfils = null;
        } else {
            foreach ($matchs as $match) {
                $matchedProfils[] = $match->getProfil1();
                $matchedProfils[] = $match->getProfil2();
            }
        }
        $repository =  $entityManager->getRepository(PhotoProfil::class);
        $photoProfil = $repository->findAll();

        return $this->render('application/mesmatchs.html.twig', [
            'photoProfil' => $photoProfil, 'matchedProfils' => $matchedProfils,
        ]);
    }
}
