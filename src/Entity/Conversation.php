<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debutConversation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $finConversation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebutConversation(): ?\DateTimeInterface
    {
        return $this->debutConversation;
    }

    public function setDebutConversation(\DateTimeInterface $debutConversation): self
    {
        $this->debutConversation = $debutConversation;

        return $this;
    }

    public function getFinConversation(): ?\DateTimeInterface
    {
        return $this->finConversation;
    }

    public function setFinConversation(\DateTimeInterface $finConversation): self
    {
        $this->finConversation = $finConversation;

        return $this;
    }
}
