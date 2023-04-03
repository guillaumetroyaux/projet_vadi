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
        
        $profil =new Profil();
        $form = $this ->createFormBuilder($profil)
                      ->add('Age')
                      ->add('Prenom')
                      ->add('centreInterets')
                      ->add('Destinations_souhaitees')
                      ->add('Genre_Souhaite')
                      ->add('Budget')
                      ->add('Enregistrer', SubmitType::class, array('label' =>'Créer un profil'))
                      ->getForm();



        
        return $this->render('application/creation.html.twig',['formCreationProfil'=>$form->createView()  ]);
    }

}
