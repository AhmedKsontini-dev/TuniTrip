<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\ReservationExcursionRepository")]
class ReservationExcursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Excursion::class, inversedBy: "reservations")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Excursion $excursion = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: "integer")]
    private ?int $adult = null;

    #[ORM\Column(type: "integer")]
    private ?int $child = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateHeure = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $localisationPoint = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $statut = null;

    // --- GETTERS & SETTERS ---
    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
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

    public function getAdult(): ?int
    {
        return $this->adult;
    }

    public function setAdult(int $adult): self
    {
        $this->adult = $adult;
        return $this;
    }

    public function getChild(): ?int
    {
        return $this->child;
    }

    public function setChild(int $child): self
    {
        $this->child = $child;
        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;
        return $this;
    }

    public function getLocalisationPoint(): ?string
    {
        return $this->localisationPoint;
    }

    public function setLocalisationPoint(string $localisationPoint): self
    {
        $this->localisationPoint = $localisationPoint;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }
}
