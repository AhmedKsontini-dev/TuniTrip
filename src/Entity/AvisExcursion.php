<?php

namespace App\Entity;

use App\Repository\AvisExcursionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Excursion;
use App\Entity\User;

#[ORM\Entity(repositoryClass: AvisExcursionRepository::class)]
class AvisExcursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Excursion $excursion = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // -------------------- GETTERS & SETTERS --------------------

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;
        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
