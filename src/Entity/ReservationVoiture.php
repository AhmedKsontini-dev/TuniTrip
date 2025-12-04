<?php

namespace App\Entity;

use App\Repository\ReservationVoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationVoitureRepository::class)]
class ReservationVoiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voitures $voiture = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Veuillez saisir votre nom.")]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Veuillez saisir votre prénom.")]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Veuillez saisir votre date de naissance.")]
    #[Assert\LessThan("-18 years", message: "Vous devez avoir au moins 18 ans.")]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "Veuillez saisir le lieu de naissance.")]
    private ?string $lieuNaissance = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Veuillez saisir votre nationalité.")]
    private ?string $nationalite = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez saisir votre adresse.")]
    private ?string $adresse = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Veuillez saisir votre téléphone.")]
    private ?string $tel = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Veuillez saisir votre CIN / Passeport.")]
    private ?string $numCinPassport = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $cinDelivreLe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\LessThan("-2 years", message: "La date de délivrance du permis doit avoir au moins 2 ans.")]
    private ?\DateTimeInterface $permisDelivreLe = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numPermis = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $permisLieuDelivrance = null;

    #[ORM\Column(type: 'float')]
    private ?float $prixTotal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Veuillez saisir la date de début.")]
    #[Assert\GreaterThanOrEqual("today", message: "La date de début doit être aujourd'hui ou plus tard.")]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Veuillez saisir la date de fin.")]
    #[Assert\Expression(
        "this.getDateFin() >= this.getDateDebut()",
        message: "La date de fin doit être supérieure ou égale à la date de début."
    )]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    // -------- GETTERS / SETTERS ---------
    public function getId(): ?int { return $this->id; }
    public function getVoiture(): ?Voitures { return $this->voiture; }
    public function setVoiture(?Voitures $voiture): static { $this->voiture = $voiture; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): static { $this->prenom = $prenom; return $this; }

    public function getDateNaissance(): ?\DateTimeInterface { return $this->dateNaissance; }
    public function setDateNaissance(\DateTimeInterface $dateNaissance): static { $this->dateNaissance = $dateNaissance; return $this; }

    public function getLieuNaissance(): ?string { return $this->lieuNaissance; }
    public function setLieuNaissance(string $lieuNaissance): static { $this->lieuNaissance = $lieuNaissance; return $this; }

    public function getNationalite(): ?string { return $this->nationalite; }
    public function setNationalite(string $nationalite): static { $this->nationalite = $nationalite; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(string $adresse): static { $this->adresse = $adresse; return $this; }

    public function getTel(): ?string { return $this->tel; }
    public function setTel(string $tel): static { $this->tel = $tel; return $this; }

    public function getNumCinPassport(): ?string { return $this->numCinPassport; }
    public function setNumCinPassport(string $numCinPassport): static { $this->numCinPassport = $numCinPassport; return $this; }

    public function getCinDelivreLe(): ?\DateTimeInterface
    {
        return $this->cinDelivreLe;
    }

    public function setCinDelivreLe(?\DateTimeInterface $cinDelivreLe): static
    {
        $this->cinDelivreLe = $cinDelivreLe;
        return $this;
    }

    public function getPermisDelivreLe(): ?\DateTimeInterface { return $this->permisDelivreLe; }
    public function setPermisDelivreLe(?\DateTimeInterface $permisDelivreLe): static { $this->permisDelivreLe = $permisDelivreLe; return $this; }

    public function getNumPermis(): ?string { return $this->numPermis; }
    public function setNumPermis(?string $numPermis): static { $this->numPermis = $numPermis; return $this; }

    public function getPermisLieuDelivrance(): ?string { return $this->permisLieuDelivrance; }
    public function setPermisLieuDelivrance(?string $permisLieuDelivrance): static { $this->permisLieuDelivrance = $permisLieuDelivrance; return $this; }

    public function getDateDebut(): ?\DateTimeInterface { return $this->dateDebut; }
    public function setDateDebut(\DateTimeInterface $dateDebut): static { $this->dateDebut = $dateDebut; return $this; }

    public function getDateFin(): ?\DateTimeInterface { return $this->dateFin; }
    public function setDateFin(\DateTimeInterface $dateFin): static { $this->dateFin = $dateFin; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): static
    {
        $this->prixTotal = $prixTotal;
        return $this;
    }
}
