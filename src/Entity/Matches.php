<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idConversation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdConversation(): ?int
    {
        return $this->idConversation;
    }

    public function setIdConversation(int $idConversation): self
    {
        $this->idConversation = $idConversation;

        return $this;
    }
}
