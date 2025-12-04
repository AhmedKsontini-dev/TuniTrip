<?php

namespace App\Entity;

use App\Enum\TransferType;
use App\Repository\ReservationTransfertRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationTransfertRepository::class)]
class ReservationTransfert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: TrajetTransfert::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrajetTransfert $trajetTransfert = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $pickupDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $pickupTime = null;

    #[ORM\Column(length: 255)]
    private ?string $pickupLocation = null;

    #[ORM\Column(length: 255)]
    private ?string $dropoffLocation = null;

    #[ORM\Column(enumType: TransferType::class)]
    private ?TransferType $transferType = null;

    #[ORM\Column]
    private ?int $persons = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $returnPickupDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $returnPickupTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $returnPickupLocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $returnDropoffLocation = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $tel = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $whatsappNumber = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $flightNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comments = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $prixTotal = null;

    #[ORM\Column(length: 50)]
    private string $statut = 'en_attente';

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    // ----------------------------------------------------------
    // Getters & Setters
    // ----------------------------------------------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrajetTransfert(): ?TrajetTransfert
    {
        return $this->trajetTransfert;
    }

    public function setTrajetTransfert(?TrajetTransfert $trajetTransfert): self
    {
        $this->trajetTransfert = $trajetTransfert;
        return $this;
    }

    public function getPickupDate(): ?\DateTimeInterface
    {
        return $this->pickupDate;
    }

    public function setPickupDate(?\DateTimeInterface $pickupDate): self
    {
        $this->pickupDate = $pickupDate;
        return $this;
    }

    public function getPickupTime(): ?\DateTimeInterface
    {
        return $this->pickupTime;
    }

    public function setPickupTime(?\DateTimeInterface $pickupTime): self
    {
        $this->pickupTime = $pickupTime;
        return $this;
    }

    public function getPickupLocation(): ?string
    {
        return $this->pickupLocation;
    }

    public function setPickupLocation(?string $pickupLocation): self
    {
        $this->pickupLocation = $pickupLocation;
        return $this;
    }

    public function getDropoffLocation(): ?string
    {
        return $this->dropoffLocation;
    }

    public function setDropoffLocation(?string $dropoffLocation): self
    {
        $this->dropoffLocation = $dropoffLocation;
        return $this;
    }

    public function getTransferType(): ?TransferType
    {
        return $this->transferType;
    }

    public function setTransferType(?TransferType $transferType): self
    {
        $this->transferType = $transferType;
        return $this;
    }

    public function getPersons(): ?int
    {
        return $this->persons;
    }

    public function setPersons(?int $persons): self
    {
        $this->persons = $persons;
        return $this;
    }

    public function getReturnPickupDate(): ?\DateTimeInterface
    {
        return $this->returnPickupDate;
    }

    public function setReturnPickupDate(?\DateTimeInterface $returnPickupDate): self
    {
        $this->returnPickupDate = $returnPickupDate;
        return $this;
    }

    public function getReturnPickupTime(): ?\DateTimeInterface
    {
        return $this->returnPickupTime;
    }

    public function setReturnPickupTime(?\DateTimeInterface $returnPickupTime): self
    {
        $this->returnPickupTime = $returnPickupTime;
        return $this;
    }

    public function getReturnPickupLocation(): ?string
    {
        return $this->returnPickupLocation;
    }

    public function setReturnPickupLocation(?string $returnPickupLocation): self
    {
        $this->returnPickupLocation = $returnPickupLocation;
        return $this;
    }

    public function getReturnDropoffLocation(): ?string
    {
        return $this->returnDropoffLocation;
    }

    public function setReturnDropoffLocation(?string $returnDropoffLocation): self
    {
        $this->returnDropoffLocation = $returnDropoffLocation;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;
        return $this;
    }

    public function getWhatsappNumber(): ?string
    {
        return $this->whatsappNumber;
    }

    public function setWhatsappNumber(?string $whatsappNumber): self
    {
        $this->whatsappNumber = $whatsappNumber;
        return $this;
    }

    public function getFlightNumber(): ?string
    {
        return $this->flightNumber;
    }

    public function setFlightNumber(?string $flightNumber): self
    {
        $this->flightNumber = $flightNumber;
        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(?float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
