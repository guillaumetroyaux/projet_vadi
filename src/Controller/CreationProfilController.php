<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Profil;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CreationProfilController extends AbstractController
{
    #[Route('/creationProfil', name: 'creation')]
    public function create(Request $request, EntityManagerInterface $entityManager){
        
        $user = $this->getUser(); // Récupérer l'utilisateur actuellement connecté
        
        $profil = new Profil();
        $profil->setUser($user); // Définir l'utilisateur pour ce profil
        $form = $this ->createFormBuilder($profil)
                      ->add('Age')
                      ->add('Prenom')
                      ->add('Image')
                      ->add('centreInterets')
                      ->add('Destinations_souhaitees')
                      ->add('Genre_Souhaite')
                      ->add('Budget')
                      ->add('Enregistrer', SubmitType::class, array('label' =>'Créer un profil'))
                      ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profil);
            $entityManager->flush();
            $this->addFlash('success', 'Profil créé avec succès!');
            return $this->redirectToRoute('home');
        }


        
        return $this->render('application/creation.html.twig',['formCreationProfil'=>$form->createView()  ]);
    }

}
