<?php

namespace App\Entity;

use App\Repository\ExcursionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\InclusExcursion;
use App\Entity\NonInclusExcursion;
use App\Entity\ImageExcursion;
use App\Entity\ItineraireExcursion;
use App\Entity\AvisExcursion;
use App\Entity\FAQExcursion;

#[ORM\Entity(repositoryClass: ExcursionRepository::class)]
class Excursion
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $categorie = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $localisation = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $duree = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $prixParPersonne = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $aPropos = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imagePrincipale = null;

    #[ORM\Column(type: 'boolean')]
    private bool $actif = true;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $cancellation = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $ages = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $maxPers = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $guide = null;

    // Relations
    #[ORM\OneToMany(mappedBy: 'excursion', targetEntity: ImageExcursion::class, cascade: ['persist', 'remove'])]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'excursion', targetEntity: InclusExcursion::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $inclusList;

    #[ORM\OneToMany(mappedBy: 'excursion', targetEntity: NonInclusExcursion::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $nonInclusList;

    #[ORM\OneToMany(mappedBy: 'excursion', targetEntity: ItineraireExcursion::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $itineraires;

    #[ORM\OneToMany(mappedBy: "excursion", targetEntity: ExcursionDetail::class, cascade: ["persist", "remove"])]
    private Collection $details;

    #[ORM\OneToMany(mappedBy: 'excursion', targetEntity: AvisExcursion::class, cascade: ['remove'])]
    private Collection $avis;

    #[ORM\OneToMany(mappedBy: "excursion", targetEntity: ReservationExcursion::class, cascade: ["persist", "remove"])]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: "excursion", targetEntity: FAQExcursion::class, cascade: ["persist", "remove"])]
    private Collection $faq;



    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->inclusList = new ArrayCollection();
        $this->nonInclusList = new ArrayCollection();
        $this->itineraires = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->details = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->faq = new ArrayCollection();
    }

    // ------------------ GETTERS & SETTERS ------------------

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }
    public function setTitre(string $titre): self { $this->titre = $titre; return $this; }

    public function getCategorie(): ?string { return $this->categorie; }
    public function setCategorie(?string $categorie): self { $this->categorie = $categorie; return $this; }

    public function getLocalisation(): ?string { return $this->localisation; }
    public function setLocalisation(?string $localisation): self { $this->localisation = $localisation; return $this; }

    public function getDuree(): ?string { return $this->duree; }
    public function setDuree(?string $duree): self { $this->duree = $duree; return $this; }

    public function getPrixParPersonne(): ?string { return $this->prixParPersonne; }
    public function setPrixParPersonne(string $prixParPersonne): self { $this->prixParPersonne = $prixParPersonne; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getAPropos(): ?string { return $this->aPropos; }
    public function setAPropos(?string $aPropos): self { $this->aPropos = $aPropos; return $this; }

    public function getImagePrincipale(): ?string { return $this->imagePrincipale; }
    public function setImagePrincipale(?string $imagePrincipale): self { $this->imagePrincipale = $imagePrincipale; return $this; }

    public function isActif(): bool { return $this->actif; }
    public function setActif(bool $actif): self { $this->actif = $actif; return $this; }

    public function getCancellation(): ?string { return $this->cancellation; }
    public function setCancellation(?string $cancellation): self { $this->cancellation = $cancellation; return $this; }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $createdAt): self { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self { $this->updatedAt = $updatedAt; return $this; }

    // ------------------- Images -------------------
    public function getImages(): Collection { return $this->images; }
    public function addImage(ImageExcursion $image): self {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setExcursion($this);
        }
        return $this;
    }
    public function removeImage(ImageExcursion $image): self {
        if ($this->images->removeElement($image)) {
            if ($image->getExcursion() === $this) $image->setExcursion(null);
        }
        return $this;
    }

    // ------------------- Inclus -------------------
    public function getInclusList(): Collection { return $this->inclusList; }
    public function setInclusList(?Collection $inclusList): self { $this->inclusList = $inclusList ?? new ArrayCollection(); return $this; }
    public function addInclus(InclusExcursion $inclus): self { 
        if (!$this->inclusList->contains($inclus)) {
            $this->inclusList[] = $inclus;
            $inclus->setExcursion($this);
        }
        return $this;
    }
    public function removeInclus(InclusExcursion $inclus): self {
        if ($this->inclusList->removeElement($inclus)) {
            if ($inclus->getExcursion() === $this) $inclus->setExcursion(null);
        }
        return $this;
    }

    // ------------------- Non Inclus -------------------
    public function getNonInclusList(): Collection { return $this->nonInclusList; }
    public function setNonInclusList(?Collection $nonInclusList): self { $this->nonInclusList = $nonInclusList ?? new ArrayCollection(); return $this; }
    public function addNonInclus(NonInclusExcursion $nonInclus): self { 
        if (!$this->nonInclusList->contains($nonInclus)) {
            $this->nonInclusList[] = $nonInclus;
            $nonInclus->setExcursion($this);
        }
        return $this;
    }
    public function removeNonInclus(NonInclusExcursion $nonInclus): self {
        if ($this->nonInclusList->removeElement($nonInclus)) {
            if ($nonInclus->getExcursion() === $this) $nonInclus->setExcursion(null);
        }
        return $this;
    }

    // ------------------- Itinéraires -------------------
    public function getItineraires(): Collection { return $this->itineraires; }
    public function setItineraires(?Collection $itineraires): self { $this->itineraires = $itineraires ?? new ArrayCollection(); return $this; }
    public function addItineraire(ItineraireExcursion $itineraire): self {
        if (!$this->itineraires->contains($itineraire)) {
            $this->itineraires[] = $itineraire;
            $itineraire->setExcursion($this);
        }
        return $this;
    }
    public function removeItineraire(ItineraireExcursion $itineraire): self {
        if ($this->itineraires->removeElement($itineraire)) {
            if ($itineraire->getExcursion() === $this) $itineraire->setExcursion(null);
        }
        return $this;
    }

    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(ExcursionDetail $detail): static
    {
        if (!$this->details->contains($detail)) {
            $this->details->add($detail);
            $detail->setExcursion($this);
        }
        return $this;
    }

    public function removeDetail(ExcursionDetail $detail): static
    {
        if ($this->details->removeElement($detail)) {
            if ($detail->getExcursion() === $this) {
                $detail->setExcursion(null);
            }
        }
        return $this;
    }


    public function getAges(): ?string
    {
        return $this->ages;
    }

    public function setAges(?string $ages): self
    {
        $this->ages = $ages;
        return $this;
    }

    public function getMaxPers(): ?int
    {
        return $this->maxPers;
    }

    public function setMaxPers(?int $maxPers): self
    {
        $this->maxPers = $maxPers;
        return $this;
    }

    public function getGuide(): ?string
    {
        return $this->guide;
    }

    public function setGuide(?string $guide): self
    {
        $this->guide = $guide;
        return $this;
    }

     public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvis(AvisExcursion $avisExcursion): self
    {
        if (!$this->avis->contains($avisExcursion)) {
            $this->avis->add($avisExcursion);
            $avisExcursion->setExcursion($this);
        }

        return $this;
    }

    public function removeAvis(AvisExcursion $avisExcursion): self
    {
        if ($this->avis->removeElement($avisExcursion)) {
            // set the owning side to null (unless already changed)
            if ($avisExcursion->getExcursion() === $this) {
                $avisExcursion->setExcursion(null);
            }
        }

        return $this;
    }

    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(ReservationExcursion $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setExcursion($this);
        }

        return $this;
    }

    public function removeReservation(ReservationExcursion $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            if ($reservation->getExcursion() === $this) {
                $reservation->setExcursion(null);
            }
        }

        return $this;
    }

    // ------------------- FAQ -------------------
    public function getFaq(): Collection
    {
        return $this->faq;
    }

    public function addFaq(FAQExcursion $faqExcursion): self
    {
        if (!$this->faq->contains($faqExcursion)) {
            $this->faq->add($faqExcursion);
            $faqExcursion->setExcursion($this);
        }
        return $this;
    }

    public function removeFaq(FAQExcursion $faqExcursion): self
    {
        if ($this->faq->removeElement($faqExcursion)) {
            if ($faqExcursion->getExcursion() === $this) {
                $faqExcursion->setExcursion(null);
            }
        }
        return $this;
    }
}
