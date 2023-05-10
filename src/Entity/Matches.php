<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: profil::class, inversedBy: 'matches')]
    private Collection $profil;


    
    #[ORM\ManyToOne(targetEntity: Profil::class, inversedBy: 'matches')]
    private $profil1;

    #[ORM\ManyToOne(targetEntity: Profil::class, inversedBy: 'matches')]
    private $profil2;

    public function __construct()
    {
        $this->profil = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, profil>
     */
    public function getProfil(): Collection
    {
        return $this->profil;
    }

    public function addProfil(profil $profil): self
    {
        if (!$this->profil->contains($profil)) {
            $this->profil->add($profil);
        }

        return $this;
    }

    public function removeProfil(profil $profil): self
    {
        $this->profil->removeElement($profil);

        return $this;
    }

    public function getProfil1(): ?Profil
    {
        return $this->profil1;
    }

    public function setProfil1(?Profil $profil1): self
    {
        $this->profil1 = $profil1;

        return $this;
    }

    public function getProfil2(): ?Profil
    {
        return $this->profil2;
    }

    public function setProfil2(?Profil $profil2): self
    {
        $this->profil2 = $profil2;

        return $this;
    }
}
