<?php

namespace App\Entity;

use App\Repository\FAQExcursionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Excursion;
use App\Entity\User;

#[ORM\Entity(repositoryClass: FAQExcursionRepository::class)]
class FAQExcursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'faq')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Excursion $excursion = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $reponse = null;



    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\ManyToOne(inversedBy: 'faqExcursions')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?User $user = null;

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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;
        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): self
    {
        $this->reponse = $reponse;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
