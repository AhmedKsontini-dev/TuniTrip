<?php
namespace App\Entity;

use App\Repository\ItineraireExcursionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Excursion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ItineraireExcursionRepository::class)]
class ItineraireExcursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'itineraires', targetEntity: Excursion::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Excursion $excursion = null;

    #[ORM\Column(length: 255)]
    private ?string $titreEtape = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descriptionEtape = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $coordinates = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $dureeVisite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $admission = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $hasPhotos = false;

    #[ORM\OneToMany(mappedBy: 'itineraire', targetEntity: ItinerairePhoto::class, cascade: ['persist', 'remove'])]
    private Collection $photos;

    public function __construct() {
        $this->photos = new ArrayCollection();
    }

    // GETTERS & SETTERS UNIQUES
    public function getId(): ?int { return $this->id; }

    public function getExcursion(): ?Excursion { return $this->excursion; }
    public function setExcursion(Excursion $excursion): self { $this->excursion = $excursion; return $this; }

    public function getTitreEtape(): ?string { return $this->titreEtape; }
    public function setTitreEtape(string $titreEtape): self { $this->titreEtape = $titreEtape; return $this; }

    public function getDescriptionEtape(): ?string { return $this->descriptionEtape; }
    public function setDescriptionEtape(?string $descriptionEtape): self { $this->descriptionEtape = $descriptionEtape; return $this; }

    public function getOrdre(): ?int { return $this->ordre; }
    public function setOrdre(?int $ordre): self { $this->ordre = $ordre; return $this; }

    public function getCoordinates(): ?string { return $this->coordinates; }
    public function setCoordinates(?string $coordinates): self { $this->coordinates = $coordinates; return $this; }

    public function getDureeVisite(): ?string { return $this->dureeVisite; }
    public function setDureeVisite(?string $dureeVisite): self { $this->dureeVisite = $dureeVisite; return $this; }

    public function getAdmission(): ?string { return $this->admission; }
    public function setAdmission(?string $admission): self { $this->admission = $admission; return $this; }

    public function isHasPhotos(): bool { return $this->hasPhotos; }
    public function setHasPhotos(bool $hasPhotos): self { $this->hasPhotos = $hasPhotos; return $this; }

    public function getPhotos(): Collection { return $this->photos; }
    public function addPhoto(ItinerairePhoto $photo): self { 
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setItineraire($this);
        }
        return $this; 
    }
    public function removePhoto(ItinerairePhoto $photo): self {
        if ($this->photos->removeElement($photo)) {
            if ($photo->getItineraire() === $this) {
                $photo->setItineraire(null);
            }
        }
        return $this;
    }
}
