<?php

namespace App\Entity;

use App\Repository\ImageExcursionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Excursion;

#[ORM\Entity(repositoryClass: ImageExcursionRepository::class)]
class ImageExcursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $imageUrl = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isPrincipale = false;

    #[ORM\Column(nullable: true)]
    private ?int $ordreAffichage = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Excursion $excursion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function isPrincipale(): bool
    {
        return $this->isPrincipale;
    }

    public function setIsPrincipale(bool $isPrincipale): self
    {
        $this->isPrincipale = $isPrincipale;
        return $this;
    }

    public function getOrdreAffichage(): ?int
    {
        return $this->ordreAffichage;
    }

    public function setOrdreAffichage(?int $ordreAffichage): self
    {
        $this->ordreAffichage = $ordreAffichage;
        return $this;
    }

    public function getExcursion(): ?Excursion
    {
        return $this->excursion;
    }

    public function setExcursion(?Excursion $excursion): self
    {
        $this->excursion = $excursion;
        return $this;
    }
}
