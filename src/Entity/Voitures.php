<?php

namespace App\Entity;

use App\Repository\VoituresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoituresRepository::class)]
class Voitures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 30)]
    private ?string $immatriculation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $prixJour = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $disponible = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $boiteVitesse = null;

    #[ORM\Column]
    private ?bool $climatiseur = null;

    #[ORM\Column]
    private ?int $passengers = null;

    #[ORM\Column]
    private ?int $suitcases = null;

    #[ORM\Column (type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?int $prixMois = null;

    // ---------- Getters & Setters ----------

    public function getId(): ?int { return $this->id; }
    public function getMarque(): ?string { return $this->marque; }
    public function setMarque(string $marque): static { $this->marque = $marque; return $this; }
    public function getModele(): ?string { return $this->modele; }
    public function setModele(string $modele): static { $this->modele = $modele; return $this; }
    public function getImmatriculation(): ?string { return $this->immatriculation; }
    public function setImmatriculation(string $immatriculation): static { $this->immatriculation = $immatriculation; return $this; }
    public function getPrixJour(): ?string { return $this->prixJour; }
    public function setPrixJour(string $prixJour): static { $this->prixJour = $prixJour; return $this; }
    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): static { $this->image = $image; return $this; }
    public function isDisponible(): ?bool { return $this->disponible; }
    public function setDisponible(bool $disponible): static { $this->disponible = $disponible; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }
    public function getBoiteVitesse(): ?string { return $this->boiteVitesse; }
    public function setBoiteVitesse(string $boiteVitesse): static { $this->boiteVitesse = $boiteVitesse; return $this; }
    public function isClimatiseur(): ?bool { return $this->climatiseur; }
    public function setClimatiseur(bool $climatiseur): static { $this->climatiseur = $climatiseur; return $this; }
    public function getPassengers(): ?int { return $this->passengers; }
    public function setPassengers(int $passengers): static { $this->passengers = $passengers; return $this; }
    public function getSuitcases(): ?int { return $this->suitcases; }
    public function setSuitcases(int $suitcases): static { $this->suitcases = $suitcases; return $this; }
    public function getPrixMois(): ?int { return $this->prixMois; }
    public function setPrixMois(int $prixMois): static { $this->prixMois = $prixMois; return $this; }



}
