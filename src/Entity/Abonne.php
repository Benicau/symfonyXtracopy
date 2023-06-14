<?php

namespace App\Entity;

use App\Repository\AbonneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonneRepository::class)]
class Abonne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(nullable: true)]
    private ?int $color = null;

    #[ORM\Column(nullable: true)]
    private ?int $blackWhite = null;

    public function __construct()
    {
        $this->color = 0; // Définition de la valeur par défaut
        $this->blackWhite = 0; // Définition de la valeur par défaut
    }

    public function getId(): ?int
    {
        return $this->id;
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
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(?int $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getBlackWhite(): ?int
    {
        return $this->blackWhite;
    }

    public function setBlackWhite(?int $blackWhite): self
    {
        $this->blackWhite = $blackWhite;

        return $this;
    }
}
