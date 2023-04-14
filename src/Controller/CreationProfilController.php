<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Profil;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\PhotoProfil;
use App\Form\ProfilType;
use App\Form\PhotoProfilType;



class CreationProfilController extends AbstractController
{
    #[Route('/creationProfil', name: 'creation')]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {

        $user = $this->getUser(); // Récupérer l'utilisateur actuellement connecté
        $profil = new Profil();
        $profil->setUser($user); // Définir l'utilisateur pour ce profil
        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profil->setUser($this->getUser());
            $entityManager->persist($profil);
            $entityManager->flush();
        }

        $idProfil = $entityManager->getRepository(Profil::class)->findOneBy(['user' => $this->getUser()->getId()]);
        // $idProfil = $entityManager->getRepository(Profil::class)->findOneBy(['user' => $this->getUser()]);
        // $idProfil = $profil->find(['user' => $this->getUser()]);
        $photoProfil = new PhotoProfil();
        $form2 = $this->createForm(PhotoProfilType::class, $photoProfil);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {

            $photoFile = $form2->get('photoProfils')->getData();
            $photoProfil = new PhotoProfil();
            $photoProfil->setProfil($idProfil->getId());
            // $photoProfil->setProfil($idProfil);


            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '.' . $photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('upload_directory', $newFilename)
                    );
                } catch (FileException $e) {
                    // handle exception
                }

                $photoProfil->setNom($newFilename);
            }

            $entityManager->persist($photoProfil);
            $entityManager->flush();
            $this->addFlash('success', 'Profil créé avec succès!');
            return $this->redirectToRoute('home');
        }



        return $this->render('application/creation.html.twig', ['formCreationProfil' => $form->createView(), 'formCreationPhoto' => $form2->createView()]);
    }
}
