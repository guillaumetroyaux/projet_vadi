<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
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

    #[ORM\Column]
    private ?int $popularity = null;

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
}
