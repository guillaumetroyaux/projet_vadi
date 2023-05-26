<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Profil;
use App\Entity\Conversation;
use App\Entity\Message;
use DateTimeImmutable;




class ConversationController extends AbstractController
{
    #[Route('/conversation/{profilId}', name: 'conversation')]
    public function createConversation(EntityManagerInterface $entityManager, Request $request, int $profilId): Response
    {
        // Récupérer le profil de l'utilisateur connecté
        $profil1 = $entityManager->getRepository(Profil::class)->findOneBy(['user' => $this->getUser()]);
        // Récupérer le profil sélectionné
        $profil2 = $entityManager->getRepository(Profil::class)->find($profilId);
        // Vérifier si une conversation existe déjà entre les profils
        $existingConversation = $entityManager->getRepository(Conversation::class)->findByParticipants([$profil1, $profil2]);
        if ($existingConversation) {
            return $this->redirectToRoute('conversation', ['profilId' => $existingConversation[0]->getId()]);
        }

        // Créer une nouvelle instance de Conversation
        $conversation = new Conversation();
        $conversation->addParticipant($profil1);
        $conversation->addParticipant($profil2);
        $conversation->setDebutConversation(new \DateTime());
        // $match->setIdConversation($conversation->getId());

        // Enregistrer la conversation en base de données
        $entityManager->persist($conversation);
        $entityManager->flush();

        // Rediriger vers la page de conversation avec l'identifiant de la conversation
        return $this->render('application/discussion.html.twig', [
            'conversation' => $conversation, 'conversationId' => $conversation->getId(), 'profilId' => $profilId
        ]);
    }

    #[Route('/send-message/{conversationId}/{profilId}', name: 'send_message')]
    public function sendMessage(EntityManagerInterface $entityManager, Request $request, int $conversationId,  int $profilId): Response
    {
        // Récupérer la conversation
        $conversation = $entityManager->getRepository(Conversation::class)->find($conversationId);

        // Récupérer le contenu du message depuis la requête
        $content = $request->request->get('message');

        // Récupérer le profil de l'utilisateur connecté
        $auteur = $entityManager->getRepository(Profil::class)->findOneBy(['user' => $this->getUser()]);

        // Créer une nouvelle instance de Message
        $message = new Message();
        $message->setConversation($conversation);
        $message->setAuteur($auteur);
        $message->setContenu($content);
        $message->setCreatedAt(DateTimeImmutable::createFromMutable(new \DateTime()));
        // Enregistrer le message en base de données
        $entityManager->persist($message);
        $entityManager->flush();

        // Récupérer le profilId du deuxième participant
        $profilId = $conversation->getParticipants()[1]->getId();

        // Rediriger vers la page de la conversation mise à jour
        return $this->redirectToRoute('conversation', ['profilId' => $profilId]);
    }
}
