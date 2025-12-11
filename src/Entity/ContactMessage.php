<?php

namespace App\Entity;

use App\Repository\ContactMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactMessageRepository::class)]
class ContactMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/u",
        message: "Le nom ne doit contenir que des lettres."
    )]
    private ?string $nom = null;

    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "L'email n'est pas valide.")]
    private ?string $email = null;

    #[Assert\NotBlank(message: "Le sujet est obligatoire.")]
    private ?string $sujet = null;

    #[Assert\NotBlank(message: "Le message est obligatoire.")]
    #[Assert\Length(
        min: 10,
        minMessage: "Votre message doit contenir au moins 10 caractères."
    )]
    private ?string $message = null;

    #[ORM\Column(type: 'boolean')]
    private bool $lus = false;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateEnvoi = null;

    // === Getters & Setters ===

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;
        return $this;
    }

    public function isLus(): bool
    {
        return $this->lus;
    }

    public function setLus(bool $lus): self
    {
        $this->lus = $lus;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;
        return $this;
    }
}
