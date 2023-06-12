<?php

namespace App\Entity;

use App\Repository\AbonnéRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnéRepository::class)]
class Abonné
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbrColor = null;

    #[ORM\Column]
    private ?int $nbrBl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrColor(): ?int
    {
        return $this->nbrColor;
    }

    public function setNbrColor(int $nbrColor): self
    {
        $this->nbrColor = $nbrColor;

        return $this;
    }

    public function getNbrBl(): ?int
    {
        return $this->nbrBl;
    }

    public function setNbrBl(int $nbrBl): self
    {
        $this->nbrBl = $nbrBl;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }
}
