<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $centreInterets = null;

    #[ORM\Column(length: 255)]
    private ?string $DestinationsSouhaitees = null;

    #[ORM\Column(length: 50)]
    private ?string $genreSouhaite = null;

    #[ORM\Column(nullable: true)]
    private ?int $Budget = null;

    #[ORM\Column(nullable: true)]
    private ?int $popularity = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?PhotoProfil $PhotoProfil = null;

    #[ORM\ManyToMany(targetEntity: Matches::class, mappedBy: 'profil')]
    private Collection $matches;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\ManyToMany(targetEntity: Conversation::class, mappedBy: 'participants')]
    private Collection $conversations;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCentreInterets(): ?string
    {
        return $this->centreInterets;
    }

    public function setCentreInterets(?string $centreInterets): self
    {
        $this->centreInterets = $centreInterets;

        return $this;
    }

    public function getDestinationsSouhaitees(): ?string
    {
        return $this->DestinationsSouhaitees;
    }

    public function setDestinationsSouhaitees(string $DestinationsSouhaitees): self
    {
        $this->DestinationsSouhaitees = $DestinationsSouhaitees;

        return $this;
    }

    public function getGenreSouhaite(): ?string
    {
        return $this->genreSouhaite;
    }

    public function setGenreSouhaite(string $genreSouhaite): self
    {
        $this->genreSouhaite = $genreSouhaite;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->Budget;
    }

    public function setBudget(?int $Budget): self
    {
        $this->Budget = $Budget;

        return $this;
    }

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(int $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getPhotoProfil(): ?PhotoProfil
    {
        return $this->PhotoProfil;
    }

    public function setPhotoProfil(?PhotoProfil $PhotoProfil): self
    {
        $this->PhotoProfil = $PhotoProfil;

        return $this;
    }

    /**
     * @return Collection<int, Matches>
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Matches $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches->add($match);
            $match->addProfil($this);
        }

        return $this;
    }

    public function removeMatch(Matches $match): self
    {
        if ($this->matches->removeElement($match)) {
            $match->removeProfil($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setAuteur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getAuteur() === $this) {
                $message->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Conversation>
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations->add($conversation);
            $conversation->addParticipant($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            $conversation->removeParticipant($this);
        }

        return $this;
    }
}
