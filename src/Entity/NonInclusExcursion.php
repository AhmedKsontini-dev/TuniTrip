<?php

namespace App\Entity;

use App\Repository\NonInclusExcursionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Excursion;

#[ORM\Entity(repositoryClass: NonInclusExcursionRepository::class)]
class NonInclusExcursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'nonInclusList')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Excursion $excursion = null;

    #[ORM\Column(length: 255)]
    private ?string $item = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

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

    public function getItem(): ?string
    {
        return $this->item;
    }

    public function setItem(string $item): self
    {
        $this->item = $item;
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
