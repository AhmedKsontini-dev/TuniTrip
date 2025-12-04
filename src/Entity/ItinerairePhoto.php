<?php

namespace App\Entity;

use App\Repository\ItinerairePhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItinerairePhotoRepository::class)]
class ItinerairePhoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: ItineraireExcursion::class, inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?ItineraireExcursion $itineraire = null;

    #[ORM\Column(length: 255)]
    private ?string $imageUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legende = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    // -------------------- GETTERS & SETTERS --------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItineraire(): ?ItineraireExcursion
    {
        return $this->itineraire;
    }

    public function setItineraire(?ItineraireExcursion $itineraire): self
    {
        $this->itineraire = $itineraire;
        return $this;
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

    public function getLegende(): ?string
    {
        return $this->legende;
    }

    public function setLegende(?string $legende): self
    {
        $this->legende = $legende;
        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(?int $ordre): self
    {
        $this->ordre = $ordre;
        return $this;
    }
}